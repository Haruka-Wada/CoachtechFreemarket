@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/user.css') }}">
@endsection

@section('main')
<div class="main__user">
    <div class="main__user__contents">
        <div class="main__user__image">
            @if($user->thumbnail)
            <img src="{{ $user->thumbnail }}" alt="ユーザーサムネイル">
            @endif
        </div>
        <div class="main__user__profile">
            <p>{{ $user->name ? $user->name : "ユーザー名" }}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $user->address}}</p>
            <p>{{ $user->building }}</p>
        </div>
    </div>
</div>

<div class="main__mail">
    <form action="/admin/user/mail/" method="get">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <button>メールを送信する</button>
    </form>
</div>

<div class="item__wrapper">
    <ul class="item__tab" id="tab_control">
        <li class="active">出品した商品</li>
        <li>注文した商品</li>
        <li>コメント一覧</li>
    </ul>
    <div class="item__contents" id="tabbody">
        <div class="item__content active">
            @foreach($user->items as $item)
            <div class="main__item">
                <form action="/item/" method="get" class="item__form">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button class="item__image-button">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}">
                    </button>
                </form>
                <div class="main__item-text">
                    <p>{{ $item->name }}</p>
                    <p>¥{{ number_format($item->price) }}</p>
                    @if($item->is_purchased === 1)
                    <p>sold out</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="item__content">
            @foreach($user->orders as $order)
            <div class="main__item">
                <form action="/item/" method="get" class="item__form">
                    <input type="hidden" name="item_id" value="{{ $order->item->id }}">
                    <button class="item__image-button">
                        <img src="{{ $order->item->image }}" alt="{{ $order->item->name }}">
                    </button>
                </form>
                <div class="main__item-text">
                    <p>{{ $order->item->name }}</p>
                    <p>¥{{ number_format($order->item->price) }}</p>
                    @if($order->payment_method_types === 'card')
                    <p>クレジットカード</p>
                    @elseif($order->payment_method_types === 'konbini')
                    <p>コンビニ</p>
                    @else
                    <p>銀行振込</p>
                    @endif
                    @if($order->payment_status === 'paid')
                    <p>決済済み</p>
                    @elseif($order->payment_status === 'unpaid')
                    <p>決済待ち</p>
                    @else
                    <p>有効期限切れ</p>
                    <p>未購入</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="item__content">
            @foreach($user->comments as $comment)
            <div class="main__item">
                <form action="/item/" method="get" class="item__form">
                    <input type="hidden" name="item_id" value="{{ $comment->item->id }}">
                    <button class="item__image-button">
                        <img src="{{ $comment->item->image }}" alt="{{ $comment->item->name }}">
                    </button>
                </form>
                <div class="main__item-text comment-text">
                    <div class="main__item-text__comment">
                        <p>{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                        <form action="/admin/comment/delete" method="post">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <button>削除</button>
                        </form>
                    </div>
                    <p>{{ $comment->comment }}</p>
                </div>
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