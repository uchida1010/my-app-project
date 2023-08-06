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
                                <td><input type="text" name="todo_name" value="" placeholder="TODO名を入力">
                                    @if ($errors->has('todo_name'))
                                    <div class="text-danger">
                                        <p>{{$errors->first('todo_name')}}</p>
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
                                        <option value="{{ $rank_value }}">{{ $rank_value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('rank'))
                                    <div class="text-danger">
                                        <p>{{$errors->first('rank')}}</p>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>期限</th>
                                <td>
                                    <input type="date" name="limit" value="{{ $limit }}">
                                    @if ($errors->has('limit'))
                                    <div class="text-danger">
                                        <p>{{$errors->first('limit')}}</p>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>完了予定</th>
                                <td>
                                    <input type="date" name="completed" value="{{ $completed }}">
                                    @if ($errors->has('completed'))
                                    <div class="text-danger">
                                        <p>{{$errors->first('completed')}}</p>
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
                                        <option value="{{$progress_value}}">{{ $progress_value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('progress'))
                                    <div class="text-danger">
                                        <p>{{$errors->first('progress')}}</p>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>備考</th>
                                <td>
                                    <textarea type="text" name="others" value="{{ $others }}" placeholder="キーワードを入力"></textarea>
                                    @if ($errors->has('others'))
                                <div class="text-danger">
                                    <p>{{$errors->first('others')}}</p>
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