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
                <img id="thumbnail" src="{{ Auth::user()->thumbnail ? Auth::user()->thumbnail : "" }}" alt="">
            </div>
            <div class="main__img-form">
                <button type="button" class="main__img-form-button">画像を選択する</button>
            </div>
            <input type="file" class="main__img-form-file" name="thumbnail">
        </div>
        <div class="main__item">
            <p>ユーザー名</p>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <input type="text" name="name" value="{{ Auth::user()->name ? Auth::user()->name : old('name') }}">
        </div>
        <div class="main__item">
            <p>郵便番号</p>
            <div class="form__error">
                @error('post_code')
                {{ $message }}
                @enderror
            </div>
            <input type="number" name="post_code" value="{{ Auth::user()->post_code ? Auth::user()->post_code : old('post_code') }}">
        </div>
        <div class="main__item">
            <p>住所</p>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
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
    //　画像選択ボタンクリック時にファイル選択画面に移行する
    document.querySelector(".main__img-form-button").addEventListener("click", () => {
        document.querySelector(".main__img-form-file").click();
    });

    // ファイル選択後にプレビュー表示する
    const fileInput = document.querySelector("input[type=file]");
    fileInput.addEventListener("change", function(e) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $("#thumbnail").attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    })
</script>
@endsection