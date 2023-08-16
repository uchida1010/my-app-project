<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoCreateRequest extends FormRequest
{

    protected $redirect = 'todolist/create';

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
            'completed' => 'required|date|after:limit',
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
            'todo_name.required' => ':attributeを入力してください',
            'todo_name.max' => '文字数の範囲内で入力してください',
            'rank.required' => ':attributeを選択してください',
            'rank' => ':attributeを正しく選択してください',
            'limit.required' => ':attributeを入力してください',
            'limit.date' => ':attributeを正しく入力してください',
            'limit.after' => '今日以降の日付を入力してください',
            'completed.required' => ':attributeを入力してください',
            'completed.date' => ':attributeを正しく入力してください',
            'completed.after' => '期限以降の日付を入力してください',
            'progress.required' => ':attributeを選択してください',
            'progress' => ':attributeを正しく選択してください',
            'others.max' => '文字数の範囲内で入力してください'
          ];
}

public function attributes(): array
{
    return [
        'todo_name' => 'TODO名',
        'rank' => '優先順位',
        'limit' => '期限',
        'completed' => '完了予定',
        'progress' => '完了(有無)'
    ];
}
}
