<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    function index(Request $request)
    {
        // mengubah data berdasarkan request status
        $datas = [];
        $paginated = false;
        if (Gate::allows('is_admin')) {
            list($datas, $paginated) = $this->indexAdmin($request);
        } else {
            list($datas, $paginated) = $this->indexPIC($request);
        }
        // returning to home with data task
        // dd($datas[1]);
        return view("home", ['datas' => $datas, "paginated" => $paginated]);
    }
    function newTask()
    {
        $user = User::all();
        $image = Image::all();
        $user_without_admin = $user->forget(0);
        return view("create", ['users' => $user_without_admin, 'images' => $image]);
    }
    function create(Request $request)
    {
        if (isset($request->publish)) {
            // if the user is a number then we push the request user and set the status to 2
            $validated = $request->validate([
                'user_id' => 'required',
                'image_id' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);
            // published
            $status = 2;
            $published = Carbon::now();
        } else {
            //else, only saving then
            $validated = $request->validate([
                'image_id' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);
            $status = 1;
            $published = null;
            $validated['user_id'] = null;
        }
        // insert necessary value
        $validated['status_id'] = $status;
        $validated['published_at'] = $published;

        // creating data at database
        Task::create($validated);
        return redirect()->route('homeScreen');
    }
    function show($id)
    {
        $task = Task::with('user', 'image', 'status')->find($id);
        // dd($task);
        $user = User::all();
        $image = Image::all();
        $user_without_admin = $user->forget(0);
        return view("edit", ['datas' => $task, 'users' => $user_without_admin, 'images' => $image]);
    }
    function edit(Task $id, Request $request)
    {
        // saving
        if (Gate::allows('is_admin')) {
            if (!empty($request->user_id)) {
                $validated = $request->validate([
                    'user_id' => 'required|numeric',
                    'image_id' => 'required',
                    'title' => 'required',
                    'description' => 'required',
                    "submit" => 'required',
                ]);
                // published
                $status = 2;
                $published = Carbon::now();
            } else {
                $validated = $request->validate([
                    'image_id' => 'required',
                    'title' => 'required',
                    'description' => 'required',
                    "submit" => 'required',
                ]);
                $status = 1;
                $published = null;
                $validated['user_id'] = null;
            }
            $status = $validated['submit']?4:$status;
            $validated['published_at'] = $published;
        }
        //for PIC
        else {
            $validated = $request->validate([
                // 'user_id' => 'required|numeric',
                // 'image_id' => 'required',
                // 'title' => 'required',
                // 'description' => 'required',
                'note' => 'required',
            ]);
            // published
            $status = 3;
        }

        $validated['status_id'] = $status;


        // creating data at database
        $id->update($validated);
        return redirect()->route('homeScreen');
    }
    function done($id)
    {
        // softDelete
        $task = Task::find($id);
        $task->deleted_at = now();
        $task->update();
        return redirect()->route('homeScreen');
    }
    function indexAdmin($request)
    {
        if (isset($request->status)) {
            $statuses = ['draft', 'published', 'validated', 'done', 'user'];
            $status_id = array_search($request->status, $statuses) + 1;
            if ($status_id == 5) {
                $user = User::paginate(5)->withQueryString();;
                $datas = $user;
            } else {
                $datas = Task::where("status_id", "=", $status_id)->paginate(5)->withQueryString();;
            }
            $datas = collect([$status_id => $datas]);
            $paginated = true;
        }
        // secara default
        else {
            // menampilkan list tugas diurut berdasar tanggal tugas
            $task = Task::orderBy('created_at')->with('image')->get();
            //menampilkan list tugas dikelompokkan berdasar status dan disort berdasarkan statusnya
            $task = $task->sortBy('status_id')->groupBy('status_id');
            //mengurutkan list tugas status done berdasarkan tanggal terhapus (sorting by deleted time) optional
            $datas = $task->sortBy('published_at');
            $paginated = false;
        }
        return array($datas, $paginated);
    }
    function indexPIC($request)
    {
        $user_id = $request->user()->id;
        if (isset($request->status)) {
            $statuses = ['error', 'published', 'validated'];
            if (!array_search($request->status, $statuses)) {
                $datas = [];
                $paginated = false;
                return array($datas, $paginated);
            }
            $status_id = array_search($request->status, $statuses) + 1;
            $datas = Task::where("status_id", "=", $status_id)->where('user_id', "=", $user_id)->paginate(5)->withQueryString();
            $datas = collect([$status_id => $datas]);
            $paginated = true;
        }
        // secara default
        else {
            // menampilkan list tugas diurut berdasar tanggal tugas
            $task = Task::orderBy('created_at')->with('image')->where('user_id', "=", $user_id)->get();
            //menampilkan list tugas dikelompokkan berdasar status dan disort berdasarkan statusnya
            $task = $task->sortBy('status_id')->groupBy('status_id');
            //mengurutkan list tugas status done berdasarkan tanggal terhapus (sorting by deleted time) optional
            $datas = $task->sortBy('published_at');
            $paginated = false;
        }
        return array($datas, $paginated);
    }
}
