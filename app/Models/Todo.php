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
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        $users = new User;

        try {
            DB::beginTransaction();
            $users->todo()->create([$validated,
            'user_id' => $user['id']]);
            DB::commit();
            return true;
        } catch (QueryException $e) {
            Log::error("TODOの登録に失敗しました。".$e->getMessage());
            DB::rollBack();
            return false;
        }
    }
}
