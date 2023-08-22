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
            'name' => 'required|max:255',
            'rank' => ['required', Rule::in(['高', '中','低'])],
            'deadline' => 'required|date|after:today',
            'schedule' => 'required|date|after:deadline',
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
            'name.required' => ':attributeを入力してください',
            'name.max' => '文字数の範囲内で入力してください',
            'rank.required' => ':attributeを選択してください',
            'rank' => ':attributeを正しく選択してください',
            'deadline.required' => ':attributeを入力してください',
            'deadline.date' => ':attributeを正しく入力してください',
            'deadline.after' => '今日以降の日付を入力してください',
            'schedule.required' => ':attributeを入力してください',
            'schedule.date' => ':attributeを正しく入力してください',
            'schedule.after' => '期限以降の日付を入力してください',
            'progress.required' => ':attributeを選択してください',
            'progress' => ':attributeを正しく選択してください',
            'others.max' => '文字数の範囲内で入力してください'
          ];
}

public function attributes(): array
{
    return [
        'name' => 'TODO名',
        'rank' => '優先順位',
        'deadline' => '期限',
        'schedule' => '完了予定',
        'progress' => '完了(有無)'
    ];
}
}
