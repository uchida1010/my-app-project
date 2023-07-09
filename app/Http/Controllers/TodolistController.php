<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function getIndex()
{
    $todos = Todo::get();

     return view('todolist.index')->with('todos',$todos);
}

}