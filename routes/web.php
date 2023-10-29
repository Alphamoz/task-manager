<?php

use App\Http\Controllers\TaskManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/home', [TaskManagerController::class, 'index'])->name('homeScreen');
Route::get('/home/{id}', [TaskManagerController::class, 'show'])->name('detailTask');
Route::put('/home/{id}', [TaskManagerController::class, 'index'])->name('updateTask');
Route::get('/home/newTask', [TaskManagerController::class, 'newTask'])->name('newTask');
Route::post('/home/newTask', [TaskManagerController::class, 'create'])->name('createTask');
Route::delete('/home/{id}', [TaskManagerController::class, 'done'])->name('doneTask');
