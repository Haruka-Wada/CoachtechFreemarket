@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('main')
<div class="main__title">
    <h1>管理者ページ</h1>
</div>
<div class="main__mail">
    <form action="/admin/mail/" method="get">
        <button>お知らせメールを送信する</button>
    </form>
</div>
<div class="main__contents">
    <table class="main__user-table">
        <tr>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>住所</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($users as $user)
        <tr class="main__user-table__row">
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                {{ $user->post_code }}<br>
                {{ $user->address }}<br>
                {{ $user->building }}
            </td>
            <td>
                <form action="/admin/data/" method="GET">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button class="main__user-table__button">詳細</button>
                </form>
            </td>
            <td>
                <form action="/admin/user/delete" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button class="main__user-table__button delete-button">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection