@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/user.css') }}">
@endsection

@section('main')
<div class="main__title">
    <h1>ユーザー情報</h1>
</div>
<div class="main__mail">
    <form action="/admin/user/mail/" method="get">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <button>メールを送信する</button>
    </form>
</div>
<div class="main__contents">
    <div class="main__user-detail">
        <dl class="main__user-detail__text">
            <dt>名前</dt>
            <dd>{{ $user->name }}</dd>
            <dt>メールアドレス</dt>
            <dd>{{ $user->email }}</dd>
            <dt>住所</dt>
            <dd>
                {{ $user->post_code }}<br>
                {{ $user->address }}<br>
                {{ $user->building }}
            </dd>
            <dt>出品した商品</dt>
            <dd>
                <div class="main__user-detail__sell-list">
                    @foreach($user->items as $item)
                    <div class="main__user-detail__sell-list__item">
                        <div class="main__user-detail__sell-list__image">
                            <form action="/item/" method="get">
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button class="main__user-detail__sell-list__button">
                                    <img src="{{ $item->image }}" alt="{{ $item->name }}">
                                </button>
                            </form>
                        </div>
                        <div>
                            <p>{{ $item->name }}</p>
                            <p>¥{{ number_format($item->price) }}</p>
                            @if($item->is_purchased === 1)
                            <p>sold out</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </dd>
            <dt>購入した商品</dt>
            <dd>
                <div class="main__user-detail__purchase-list">
                    @foreach($user->orders as $order)
                    <div class="main__user-detail__purchase-list__item">
                        <div class="main__user-detail__purchase-list__image">
                            <form action="/item/" method="get">
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button class="main__user-detail__purchase-list__button">
                                    <img src="{{ $order->item->image }}" alt="{{ $order->item->name }}">
                                </button>
                            </form>
                        </div>
                        <div>
                            <p>{{ $order->item->name }}</p>
                            <p>¥{{ number_format($order->item->price) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </dd>
            <dt>コメント一覧</dt>
            <dd>
                <div class="main__user-detail__comment-list">
                    @foreach($user->comments as $comment)
                    <div class="main__user-detail__comment-list__item">
                        <div class="main__user-detail__comment-list__image">
                            <form action="/item/" method="get">
                                <input type="hidden" name="item_id" value="{{ $comment->item->name }}">
                                <button class="main__user-detail__comment-list__button">
                                    <img src="{{ $comment->item->image }}" alt="{{ $comment->item->name }}">
                                </button>
                            </form>
                        </div>
                        <div class="main__user-detail__comment-list__text">
                            <div class="main__user-detail__comment-list__index">
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
            </dd>
        </dl>
    </div>
</div>
@endsection