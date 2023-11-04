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
    redirect(route('homeScreen'));
});
Route::get('/home', [TaskManagerController::class, 'index'])->name('homeScreen');
Route::get('/home/new', [TaskManagerController::class, 'newTask'])->name('newTask');
Route::put('/home/{id} ', [TaskManagerController::class, 'edit'])->name('updateTask');
Route::get('/home/{id}', [TaskManagerController::class, 'show'])->name('editTask');
Route::post('/home/new', [TaskManagerController::class, 'create'])->name('createTask');
Route::delete('/home/delete/{id}', [TaskManagerController::class, 'done'])->name('doneTask');
