<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskManagerController;
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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [TaskManagerController::class, 'index'])->name('homeScreen');
Route::get('/home/new', [TaskManagerController::class, 'newTask'])->name('newTask');
Route::put('/home/{id} ', [TaskManagerController::class, 'edit'])->name('updateTask');
Route::get('/home/{id}', [TaskManagerController::class, 'show'])->name('editTask');
Route::post('/home/new', [TaskManagerController::class, 'create'])->name('createTask');
Route::delete('/home/delete/{id}', [TaskManagerController::class, 'done'])->name('doneTask');


require __DIR__.'/auth.php';
