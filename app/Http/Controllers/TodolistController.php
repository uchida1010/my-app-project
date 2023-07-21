<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class TodoListController extends Controller
{
    public function index(Request $request)
    {

        $todos = Todo::paginate(10);

        $todo_name = $request->input('todo_name');
        $rank = $request->input('rank');
        $lower_limit = $request->input('lower_limit');
        $upper_limit = $request->input('upper_limit');
        $progress = $request->input('progress');
        $others = $request->input('others');

        $rank_array = ['高', '中', '低'];
        $progress_array = ['有', '無'];

        $query = Todo::query();

        if (!empty($todo_name)) {
            $query = $query->where('name', 'like', '%' . $todo_name . '%');
        }

        if (!empty($rank)) {
            $query = $query->where('rank', $rank);
        }

        if (!empty($lower_limit) && !empty($upper_limit)) {
            $query = $query->whereBetween("deadline", [$lower_limit, $upper_limit]);
        } elseif (!empty($lower_limit) && empty($upper_limit)) {
            $query = $query->where("deadline", ">=", $lower_limit);
        } elseif (empty($lower_limit) && !empty($upper_limit)) {
            $query = $query->where("deadline", "<=" ,$upper_limit);
        }

        if (!empty($progress)) {
            $query = $query->where('progress', $progress);
        }

        if (!empty($others)) {
            $query = $query->where('others', 'like', '%' . $others . '%');
        }

        $todos = $query->paginate(10);

        $todos_array = [
            'todos' => $todos,
            'todo_name' => $todo_name,
            'rank' => $rank,
            'lower_limit' => $lower_limit,
            'upper_limit' => $upper_limit,
            'progress' => $progress,
            'others' => $others,
            'rank_array' => $rank_array,
            'progress_array' => $progress_array
        ];

        return view('todolist.index')->with($todos_array);
    }
}
