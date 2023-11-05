<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;

class TaskManagerController extends Controller
{
    function index(Request $request){
        // mengubah data berdasarkan request status
        if(isset($request->status)){
            $statuses = ['draft', 'published', 'validated', 'done', 'user'];
            $status_id=array_search($request->status, $statuses);
            if($status_id == 4){
                $user = User::all();
                $datas = $user->forget(0);
            }
            else{
                $datas = Task::all()->where("status_id","=", $status_id);
            }
            $datas = collect([$status_id=>$datas]);
        }
        // secara default
        else{
            // menampilkan list tugas diurut berdasar tanggal tugas
            $task = Task::orderBy('created_at')->with('image')->get();
            //menampilkan list tugas dikelompokkan berdasar status dan disort berdasarkan statusnya
            $task = $task->sortBy('status')->groupBy('status_id');
            //mengurutkan list tugas status done berdasarkan tanggal terhapus (sorting by deleted time) optional
            $datas = $task->sortBy('published_at');
        }
        // returning to home with data task
        return view("home", ['datas' => $datas]);
    }
    function newTask(){
        $user = User::all();
        $image = Image::all();
        $user_without_admin = $user->forget(0);
        return view("create", ['users' => $user_without_admin, 'images' =>$image]);
    }
    function create(Request $request) {
        if(isset($request->publish)){
            // if the user is a number then we push the request user and set the status to 2
            $validated = $request->validate([
                'user_id' => 'required',
                'image_id' => 'required',
                'title' => 'required',
                'description'=>'required',
            ]);
            // published
            $status = 2;
            $published = Carbon::now();
        }
        else{
            //else, only saving then
            $validated = $request->validate([
                'image_id' => 'required',
                'title' => 'required',
                'description'=>'required',
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
    function show(Task $task){
        return view("detail", ['datas' => $task]);
    }
    function edit(){
        // editting
    }
    function done(Task $task){
        // softDelete
        $task->delete();
        return redirect()->route('homeScreen');
    }
}
