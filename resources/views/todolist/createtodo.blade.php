@extends('layouts.parent')
@section('title', 'Laravel TODOアプリ 学習用')
@section('content')

<div class="main-container">
    <div class="main-text">
        <h1>Laravel TODOアプリ チュートリアル</h1>
        <p>学習用としてデモページを作成しています。</p>
    </div>
    <div class="search-wrap">
        <div class="create-box">
            <div class="search-form">
                <form action="{{ url('todolist/create') }}" method="post">
                    @csrf
                    <table class="create-table">
                        <tbody>
                            <tr>
                                <th>TODO名</th>
                                <td><input type="text" name="todo_name" value="{{old('todo_name')}}" placeholder="TODO名を入力">
                                    @if ($errors->has('todo_name'))
                                    <div class="text-danger">
                                        {{$errors->first('todo_name')}}
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            <tr class="create-row">
                                <th>優先順位</th>
                                <td>
                                    <select name="rank">
                                        <option value="">選択してください</option>
                                        @foreach($rank_array as $rank_value)
                                        <option value="{{$rank_value}}" @selected($rank_value == old('rank'))>{{ $rank_value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('rank'))
                                    <div class="text-danger">
                                        {{$errors->first('rank')}}
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>期限</th>
                                <td>
                                    <input type="date" name="limit" value="{{old('limit')}}">
                                    @if ($errors->has('limit'))
                                    <div class="text-danger">
                                        {{$errors->first('limit')}}
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>完了予定</th>
                                <td>
                                    <input type="date" name="completed" value="{{old('completed')}}">
                                    @if ($errors->has('completed'))
                                    <div class="text-danger">
                                        {{$errors->first('completed')}}
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>完了(有無)</th>
                                <td>
                                    <select name="progress">
                                        <option value="">選択してください</option>
                                        @foreach($progress_array as $progress_value)
                                        <option value="{{$progress_value}}" @selected($progress_value == old('progress'))>{{ $progress_value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('progress'))
                                    <div class="text-danger">
                                        {{$errors->first('progress')}}
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>備考</th>
                                <td>
                                    <textarea type="text" name="others" value="{{ $others }}" placeholder="キーワードを入力">{{ old('others') }}</textarea>
                                    @if ($errors->has('others'))
                                <div class="text-danger">
                                    {{$errors->first('others')}}
                                </div>
                                @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="submit" value="登録" class="btn btn-info btn-register">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection