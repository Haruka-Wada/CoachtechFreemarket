@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('main')
<div class="main__title">
    <h2>管理者ログイン</h2>
</div>

@if (Auth::guard('administrators')->check())
<div>ユーザーID {{ Auth::guard('administrators')->user()->userid }}でログイン中</div>
@endif

<div class="main__contents">
    <form action="/admin/login" method="post">
        @csrf
        <div class="main__item">
            <p>メールアドレス</p>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="main__item">
            <p>パスワード</p>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <input type="password" name="password">
        </div>
        <div class="register__button">
            <button>ログインする</button>
        </div>
    </form>
</div>
@endsection