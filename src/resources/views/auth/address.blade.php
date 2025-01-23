@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/address.css') }}">
@endsection

@section('main')
<div class="main__title">
    <h2>住所の変更</h2>
</div>
<div class="main__contents">
    <form action="/purchase/address" method="post">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item_id }}">
        <div class="main__item">
            <p>郵便番号</p>
            <input type="number" name="post_code" value="{{ Auth::user()->post_code ? Auth::user()->post_code : old('post_code') }}">
        </div>
        <div class="main__item">
            <p>住所</p>
            <input type="text" name="address" value="{{ Auth::user()->address ? Auth::user()->address : old('address') }}">
        </div>
        <div class="main__item">
            <p>建物名</p>
            <input type="text" name="building" value="{{ Auth::user()->building ? Auth::user()->building : old('building') }}">
        </div>
        <div class="update__button">
            <button>更新する</button>
        </div>
    </form>
</div>
@endsection