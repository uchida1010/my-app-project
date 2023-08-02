<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'todo_name' => 'required|max:255',
            'rank' => ['required', Rule::in(['高', '中','低'])],
            'limit' => 'required|date|after:today',
            'completed' => 'required|date|before_or_equal:completed',
            'progress' => ['required', Rule::in(['有', '無'])],
            'others' => 'max:255'
          ];
    }

        /**
 * 定義済みバリデーションルールのエラーメッセージ取得
 *
 * @return array
 */
public function messages()
{
    return 
          [
            'todo_name' => '正しい値を入力してください',
            'rank' => '正しい値を選択してください',
            'limit' => '今日以降の日付を入力してください',
            'completed' => '期限以降の日付を入力してください',
            'progress' => '正しい値を選択してください',
            'others' => '正しい値を入力してください'
          ];
}
}
