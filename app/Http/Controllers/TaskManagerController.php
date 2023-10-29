<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskManagerController extends Controller
{
    //
    function index(){
        // menampilkan list tugas diurut berdasar tanggal tugas
        $task = Task::orderBy('created_at')->get()->groupBy('status_id');
        //menampilkan list tugas dikelompokkan berdasar status
        //mengurutkan list tugas status done berdasarkan tanggal terhapus
        $task=$task->sortBy('deleted_at');
        //setiap tugas ada link untuk update dan delete

        //list user
        dd($task);
        return view("home", ['data' => $task]);

    }
    function newTask(){

    }
    function create(){

    }
    function show(){

    }
    function edit(){

    }
    function done(){

    }
    // function destroy(){

    // }
}
