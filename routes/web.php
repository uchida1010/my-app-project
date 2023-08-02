<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::prefix('todolist')->group(function () {
        Route::get('/', [TodoListController::class, 'index']);
        Route::get('create',[TodoListController::class, 'showCreateTodo']);
        Route::post('create',[TodoListController::class, 'executeCreateTodo']);
    });