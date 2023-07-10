<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class TodoListController extends Controller
{
    public function getIndex()
    {
        $todos = Todo::paginate(10);

        return view('todolist.index')->with('todos',$todos);
    }

}