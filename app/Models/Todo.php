<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Requests\TodoCreateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\TodoListController;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['todo_name', 'rank', 'limit', 'completed', 'progress', 'others'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function create($validated) {

        DB::transaction(function () use($validated) {
            todos::create([
                'todo_name' => $validated['todo_name'],
                'rank' => $validated['rank'],
                'limit' => $validated['limit'],
                'completed' => $validated['completed'],
                'progress' => $validated['progress'],
                'others' => $validated['others']
            ]);
        });
      }
}