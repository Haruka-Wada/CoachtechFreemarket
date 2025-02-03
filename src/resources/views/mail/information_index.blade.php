@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mail/index.css') }}">
@endsection

@section('main')
<div class="main__container">
    @if( Session::has('sent'))
    <div class="message">{{ session('sent') }}</div>
    @endif
    <form action="/admin/mail/send" method="post">
        @csrf
        <p>本文入力</p>
        <textarea name="message">{{ old('message') }}</textarea>
        <div class="send__button">
            <button>送信する</button>
        </div>
    </form>
    <form action="/admin" method="get">
        <div class="return__button">
            <button>戻る</button>
        </div>
    </form>
</div>
@endsection