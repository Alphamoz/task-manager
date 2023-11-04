<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskManagerController extends Controller
{
    //
    function index(){
        // menampilkan list tugas diurut berdasar tanggal tugas
        $task = Task::orderBy('created_at')->with('image')->get();
        //menampilkan list tugas dikelompokkan berdasar status dan disort berdasarkan statusnya
        $task = $task->sortBy('status')->groupBy('status_id');
        //mengurutkan list tugas status done berdasarkan tanggal terhapus (sorting by deleted time) optional
        $task=$task->sortBy('deleted_at');
        // dd($task);
        // returning to home with data task
        return view("home", ['datas' => $task]);
    }
    function newTask(){
        // return "MANTAP!";
        return view("create");
    }
    function create(){
        // return "MANTAP!";
    }
    function show(){

    }
    function edit(){

    }
    function done($id){
        // add delete stamp
        return 'mantap jiwa id: '.$id;
    }
    // function destroy(){

    // }
}
