<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rank', 'deadline', 'schedule', 'progress', 'others'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addTodo($validated)
    {

        $user = Auth::user();

        try {
            DB::beginTransaction();
            $user->todo()->create($validated);
            DB::commit();
            return true;
        } catch (QueryException $e) {
            Log::error("TODOの登録に失敗しました。".$e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function editTodo($validated, $id)
    {

        try {
            DB::beginTransaction();
            Todo::find($id)->update($validated);
            DB::commit();
            return true;
        } catch (QueryException $e) {
            Log::error("TODOの更新に失敗しました。".$e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function deleteTodo($id)
    {

        try {
            DB::beginTransaction();
            Todo::find($id)->delete();
            DB::commit();
            return true;
        } catch (QueryException $e) {
            Log::error("TODOの削除に失敗しました。".$e->getMessage());
            DB::rollBack();
            return false;
        }
    }


    public function countTodos($user_id)
    {
        return Todo::selectRaw('progress_id, COUNT(progress_id) AS count')->where('user_id', '=', $user_id)->groupBy('progress_id')->get();
    }

    public function progress(): belongsTo
    {
        return $this->belongsTo(Progress::class);
    }
}
