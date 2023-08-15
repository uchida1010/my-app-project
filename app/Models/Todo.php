<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Requests\TodoCreateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['todo_name', 'rank', 'limit', 'completed', 'progress', 'others'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function create($validated)
    {
        try {
            todos::create($validated);
        } catch (QueryException $e) {
            Log::error("登録失敗！");
        }
    }
}
