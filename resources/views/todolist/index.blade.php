@extends('layouts.parent')
@section('title', 'Laravel TODOアプリ 学習用')
@section('content')

<div class="main-container">
    <div class="main-text">
        <h1>Laravel TODOアプリ チュートリアル</h1>
        <p>学習用としてデモページを作成しています。</p>
        <a href="{{ url('todolist/create') }}" class="btn btn-success">新規作成</a>
    </div>
    <div class="search-wrap">
        <div class="search-title">
            <h2>商品検索</h2>
        </div>
        <div class="search-box">
            <div class="search-text">
                <h3>検索条件</h3>
            </div>
            <div class="search-form">
                <form action="{{url('todolist')}}" method="get">
                    <div class="search-flex">
                        <div class="search-item">
                            TODO名：<input type="text" name="name" value="{{ $name }}" placeholder="TODO名を入力">
                        </div>
                        <div class="search-item">
                            優先順位：
                            <select name="rank">
                                <option value="" >選択してください</option>
                                @foreach($rank_array as $rank_value)
                                <option value="{{ $rank_value }}" @if("$rank_value" == $rank) selected @endif >{{ $rank_value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="search-flex">
                        <div class="search-item">
                            期限：<input type="date" name="lower_limit" value="{{ $lower_limit }}">　〜
                            　<input type="date" name="upper_limit" value="{{ $upper_limit }}">
                        </div>
                        <div class="search-item">
                            完了：
                            <select name="progress_id">
                                <option value="" >選択してください</option>
                                @php
                                $i = 1;
                                @endphp
                                @foreach($progress_array as $progress_value)
                                <option value="{{ $i++ }}" @if("$progress_value" == $progress) selected @endif>{{ $progress_value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="search-item">
                            備考：<input type="text" name="others" value="{{ $others }}" placeholder="キーワードを入力">
                        </div>
                    </div>
                    <div class="search-flex search-item">
                    <a href="{{ url('todolist')}}" class="clear-btn">クリア</a>               
                   <input type="submit" value="検索" class="btn btn-info btn-search">
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <div class="todos-count">
        @foreach($counttodos as $counttodo)
        <div class="complete">{{ $counttodo['progress'] }}:{{ $counttodo['count'] }}</div>
        @endforeach
    </div>
    <!--テーブル-->
    <div class=" table-wrap">
        <table class="table">
            <thead>
                <tr class="table-info">
                    <th>NO.</th>
                    <th>ユーザーID</th>
                    <th>TODO名</th>
                    <th>優先順位</th>
                    <th>期限</th>
                    <th>完了予定</th>
                    <th>完了(有無)</th>
                    <th>備考</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                <tr class="table-info">
                    <td>{{ $todo->id }}</td>
                    <td>{{ $todo->user_id }}</td>
                    <td>{{ $todo->name }}</td>
                    <td>{{ $todo->rank }}</td>
                    <td>{{ $todo->deadline }}</td>
                    <td>{{ $todo->schedule }}</td>
                    <td>{{ $todo->progress->name }}</td>
                    <td>{{ $todo->others }}</td>
                    <td><a class="btn btn-primary" href="{{ route('todolist.editshow', ['id'=>$todo->id]) }}">編集</a></td>
                    <td><form action="{{ route('todolist.delete', ['id'=>$todo->id]) }}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-danger input-box" value="削除">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--/テーブル-->

    <!-- ページネーション -->
    <div class="pagination-links">
        {{$todos->appends(request()->query())->links()}}
    </div>
</div>

@endsection