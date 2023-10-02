<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Const\FormValue;
use App\Http\Requests\TodoCreateRequest;
use App\Http\Requests\TodoEditRequest;
use Illuminate\Support\Facades\Auth;

class TodoListController extends Controller
{

    public function index(Request $request)
    {
        $todos = Todo::paginate(10);

        $name = $request->input('name');
        $rank = $request->input('rank');
        $lower_limit = $request->input('lower_limit');
        $upper_limit = $request->input('upper_limit');
        $progress = $request->input('progress');
        $others = $request->input('others');
        $user = Auth::user();
        $todo = new Todo;

        $query = Todo::query();

        if (!empty($name)) {
            $query = $query->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($rank)) {
            $query = $query->where('rank', $rank);
        }

        if (!empty($lower_limit) && !empty($upper_limit)) {
            $query = $query->whereBetween("deadline", [$lower_limit, $upper_limit]);
        } elseif (!empty($lower_limit) && empty($upper_limit)) {
            $query = $query->where("deadline", ">=", $lower_limit);
        } elseif (empty($lower_limit) && !empty($upper_limit)) {
            $query = $query->where("deadline", "<=", $upper_limit);
        }

        if (!empty($progress)) {
            $query = $query->where('progress', $progress);
        }

        if (!empty($others)) {
            $query = $query->where('others', 'like', '%' . $others . '%');
        }

        $query = $query->where('user_id', $user->id);

        $todos = $query->paginate(10);

        $todos_array = [
            'todos' => $todos,
            'name' => $name,
            'rank' => $rank,
            'lower_limit' => $lower_limit,
            'upper_limit' => $upper_limit,
            'progress' => $progress,
            'others' => $others,
            'rank_array' => FormValue::rank_array,
            'progress_array' => FormValue::progress_array,
            'counttodos' => $todo->countTodos($user->id),
        ];

        return view('todolist.index')->with($todos_array);
    }

    public function showCreateTodo()
    {
        $name = "";
        $deadline = "";
        $schedule = "";
        $others = "";

        $todos_array = [

            'rank_array' => FormValue::rank_array,
            'progress_array' => FormValue::progress_array
        ];

        return view('todolist.createtodo', compact('name', 'deadline', 'schedule', 'others'))->with($todos_array);
    }

    public function executeCreateTodo(TodoCreateRequest $request)
    {
        $validated = $request->validated();

        $todos = new Todo;

        $todocreate = $todos->addTodo($validated);

        if ($todocreate === false) {
            return redirect('todolist/create')->withInput();
        }
        return redirect('todolist');
    }

    public function showEditTodo($id)
    {   
        $todos = Todo::find($id);

        $todos_array = [
            'rank_array' => FormValue::rank_array,
            'progress_array' => FormValue::progress_array
        ];

        return view('todolist.edittodo', compact('todos'))->with($todos_array);
    }

    public function executeEditTodo(TodoEditRequest $request, $id)
    {
        $validated = $request->validated();
        $todos = new Todo;

        $todoedit = $todos->editTodo($validated, $id);

        if ($todoedit === false) {
            return redirect( route('todolist.editexecute', ['id'=>$id]) )->withInput();
        }
        return redirect('todolist');
    }

    public function deleteTodo($id)
    {
        $todos = new Todo;

        $tododelete = $todos->deleteTodo($id);

        return redirect('todolist');
    }
}
