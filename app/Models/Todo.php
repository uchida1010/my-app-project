<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['todo_name', 'rank', 'limit', 'completed', 'progress', 'others'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addTodo($validated)
    {
        try {
            DB::beginTransaction();
            Todo::create($validated);
            DB::commit();
            return true;
        } catch (QueryException $e) {
            Log::error("TODOの登録に失敗しました。".$e);
            DB::rollBack();
            return false;
        }
    }
}
