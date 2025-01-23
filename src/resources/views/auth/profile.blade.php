@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/profile.css') }}">
@endsection

@section('main')
<div class="main__title">
        <h2>プロフィール設定</h2>
    </div>
<div class="main__contents">
    <form action="/mypage/profile" method="post" enctype="multipart/form-data">
        @csrf
        <div class="main__img">
            <div class="main__img-thumbnail">
                @if(Auth::user()->thumbnail)
                <img src="{{ Auth::user()->thumbnail }}" alt="ユーザーサムネイル">
                @endif
            </div>
            <div class="main__img-form">
                <button type="button" class="main__img-form-button">画像を選択する</button>
            </div>
            <input type="file" class="main__img-form-file" name="thumbnail">
        </div>
        <div class="main__item">
            <p>ユーザー名</p>
            <input type="text" name="name" value="{{ Auth::user()->name ? Auth::user()->name : old('name') }}">
        </div>
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

<script type="text/javascript">
    console.log(document.querySelector(".main__img-form-button"))
    document.querySelector(".main__img-form-button").addEventListener("click", () => {
        document.querySelector(".main__img-form-file").click();
    });
</script>
@endsection