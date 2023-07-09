@extends('layouts.parent')
@section('title', 'Laravel TODOアプリ 学習用')
@section('content')

@yield('layout.header')
<div class="main-container">
    <div class="main-text">
        <h1>Laravel TODOアプリ チュートリアル</h1>
        <p>学習用としてデモページを作成しています。</p>
    </div>
    <!--テーブル-->
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr class="table-info">
                    <th scope="col" width="10%">NO.</th>
                    <th scope="col" width="15%">ユーザーID</th>
                    <th scope="col" width="15%">TODO名</th>
                    <th scope="col" width="30%">優先順位</th>
                    <th scope="col" width="30%">期限</th>
                    <th scope="col" width="30%">完了予定</th>
                    <th scope="col" width="30%">進捗(%)</th>
                    <th scope="col" width="30%">備考</th>
                    <th scope="col" width="15%">編集</th>
                    <th scope="col" width="30%" colspan="3">削除</th>
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
                    <td>{{ $todo->progress }}%</td>
                    <td>{{ $todo->others }}</td>
                    <td><button type="button" class="btn btn-primary">編集</button></td>
                    <td><button type="button" class="btn btn-danger">削除</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--/テーブル-->
</div>

@yield('layout.footer')
@endsection