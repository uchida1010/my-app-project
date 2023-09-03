<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'rank', 'deadline', 'schedule', 'progress', 'others'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addTodo($validated)
    {

        $user_id = Auth::id();

        try {
            DB::beginTransaction();
            Todo::create($validated);
            $user = User::find(1);
            $user->create([
                'user_id' => $user_id
            ]);
            Todo::create([
                'user_id' => $user_id]);
            DB::commit();
            return true;
        } catch (QueryException $e) {
            Log::error("TODOの登録に失敗しました。".$e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function Todo()
    {
        return $this->morphOne(User::class, 'imageable');
    }
}
