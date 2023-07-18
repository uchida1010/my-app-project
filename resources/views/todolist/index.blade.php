@extends('layouts.parent')
@section('title', 'Laravel TODOアプリ 学習用')
@section('content')

@yield('layout.header')
<div class="main-container">
    <div class="main-text">
        <h1>Laravel TODOアプリ チュートリアル</h1>
        <p>学習用としてデモページを作成しています。</p>
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
                            TODO名：<input type="text" name="todo_name" value="{{ $todo_name }}" placeholder="TODO名を入力">
                        </div>
                        <div class="search-item">
                            優先順位：
                            <select name="rank">
                                <option value="">選択してください</option>
                                <option value="高">高</option>
                                <option value="中">中</option>
                                <option value="低">低</option>
                            </select>
                        </div>
                    </div>
                    <div class="search-flex">
                        <div class="search-item">
                            期限：<input type="date" name="lower_limit" value="{{ $lower_limit }}">　〜
                            　<input type="date" name="upper_limit" value="{{ $upper_limit }}">
                        </div>
                        <div class="search-item">
                            完了：<select name="progress">
                                <option value="">選択してください</option>
                                <option value="有">有</option>
                                <option value="無">無</option>
                            </select>
                        </div>
                        <div class="search-item">
                            備考：<input type="text" name="others" value="{{ $others }}" placeholder="キーワードを入力">
                        </div>
                    </div>
                    <div class="search-flex search-item">
                        <input type="reset" value="クリア">
                        <input type="submit" value="検索" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
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
                    <td>{{ $todo->progress }}</td>
                    <td>{{ $todo->others }}</td>
                    <td><button type="button" class="btn btn-primary">編集</button></td>
                    <td><button type="button" class="btn btn-danger">削除</button></td>
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

@yield('layout.footer')
@endsection