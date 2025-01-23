@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('main')
<div class="profile__wrapper">
    <div class="profile__contents">
        <div class="profile__image">
            @if(Auth::user()->thumbnail)
            <img src="{{ Auth::user()->thumbnail }}" alt="ユーザーサムネイル">
            @endif
        </div>
        <div class="profile__name">
            <p>{{ Auth::user()->name ? Auth::user()->name : "ユーザー名" }}</p>
        </div>
    </div>
    <div class="profile__contents-edit">
        <a href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>
<div class="item__wrapper">
    <ul class="item__tab" id="tab_control">
        <li class="active">出品した商品</li>
        <li>購入した商品</li>
    </ul>
    <div class="item__contents" id="tabbody">
        <div class="item__content active">
            @foreach($sell_items as $item)
            <div class="item__image">
                <form action="/item/" method="get" class="item__form">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button class="item__image-button">
                        <img src="{{ $item->image}}" alt="{{ $item->name }}">
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        <div class="item__content">
            @foreach($items as $item)
            <div class="item__image">
                <form action="/item/" method="get" class="item__form">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button class="item__image-button">
                        <img src="{{ $item->image}}" alt="{{ $item->name }}">
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.item__tab li').click(function() {
            var num = $('.item__tab li').index(this);
            $('.item__tab li').removeClass('active');
            $(this).addClass('active');
            $('.item__content').removeClass('active').eq(num).addClass('active')
        })
        $(this).addClass('active').siblings('li').removeClass('active');

    })
</script>
@endsection