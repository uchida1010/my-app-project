<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('todolist')->group(function () {
        Route::get('/', [App\Http\Controllers\TodoListController::class, 'index']);
        Route::get('create',[App\Http\Controllers\TodoListController::class, 'showCreateTodo']);
        Route::post('create',[App\Http\Controllers\TodoListController::class, 'executeCreateTodo']);
        Route::get('edit/{id}', [App\Http\Controllers\TodoListController::class, 'showEditTodo'])->name('todolist.editshow');
        Route::post('edit/{id}', [App\Http\Controllers\TodoListController::class, 'executeEditTodo'])->name('todolist.editexecute');
        Route::post('delete/{id}', [App\Http\Controllers\TodoListController::class, 'deleteTodo'])->name('todolist.delete');
    });
});

require __DIR__.'/auth.php';

