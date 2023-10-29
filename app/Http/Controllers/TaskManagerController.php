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
        //mengurutkan list tugas status done berdasarkan tanggal terhapus
        $task=$task->sortBy('deleted_at');
        //setiap tugas ada link untuk update dan delete
        return view("home", ['datas' => $task]);
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
