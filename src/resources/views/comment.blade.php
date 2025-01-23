@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('main')
<div class="main__container">
    <div class="item__wrapper">
        <div class="item__image">
            <img src="{{ $item->image }}" alt="{{ $item->name }}">
        </div>
    </div>
    <div class="item__wrapper">
        <div class="item__detail">
            <div class="item__name">
                <h2>{{ $item->name }}</h2>
            </div>
            <div class="item__brand">
                <p>{{ $item->brand }}</p>
            </div>
            <div class="item__price">
                <p>¥{{ number_format($item->price) }}</p>
            </div>
            <div class="item__icon">
                @auth
                @if(!$item->hasLikedBy(Auth::user()))
                <div class="item__icon-star">
                    <img class="like-toggle" src="{{ asset('img/star.png')}}" data-item-id="{{ $item->id }}" alt="お気に入り">
                    <p class="item__icon-star__counter">{{ $item->favorites_count }}</p>
                </div>
                @else
                <div class="item__icon-star">
                    <img class="like-toggle liked" data-item-id="{{ $item->id }}" src="{{ asset('img/yellow_star.png')}}" alt="お気に入り">
                    <p class="item__icon-star__counter">{{ $item->favorites_count }}</p>
                </div>
                @endif
                @endauth
                @guest
                <div class="item__icon-star">
                    <form action="/favorite" method="post">
                        @csrf
                        <button>
                            <img class="item__icon-star__button" src="{{ asset('img/star.png')}}" alt="お気に入り">
                        </button>
                    </form>
                    <p class="item__icon-star__counter">{{ $item->favorites_count }}</p>
                </div>
                @endguest
                <div class="item__icon-comment">
                    <form action="./comment/" class="item__icon-comment__form" method="get">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button>
                            <img src="{{ asset('img/comment.jpeg')}}" class="item__icon-comment__button" alt="コメント">
                        </button>
                    </form>
                    <p class="item__icon-comment__counter">{{ $item->comments_count }}</p>
                </div>
            </div>
            <div class="item__comment-area">
                @foreach($comments as $comment)
                @if($comment->user_id === Auth::id())
                <div class="comment-user-myself">
                    <div class="comment-user-thumbnail">
                        @if(Auth::user()->thumbnail)
                            <img src="{{ Auth::user()->thumbnail }}" alt="{{ Auth::user()->name }}">
                        @endif
                    </div>
                    <div class="comment-user-name">
                        <p>{{ Auth::user()->name ? Auth::user()->name : "名前"}}</p>
                    </div>
                    <form action="/comment/delete" method="post">
                        @csrf
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <button class="comment-delete">削除</button>
                    </form>
                </div>
                @else
                <div class="comment-user">
                    <div class="comment-user-thumbnail">
                        @if($comment->user->thumbnail)
                            <img src="{{ $comment->user->thumbnail }}" alt="{{ $comment->user->name }}">
                        @endif
                    </div>
                    <div class="comment-user-name">
                        <p>{{ $comment->user->name ? $comment->user->name : "名前" }}</p>
                    </div>
                </div>
                @endif
                <div class="comment-text">
                    {{ $comment->comment }}
                </div>
                @endforeach
            </div>
            <div class="item__comment-form">
                <div class="comment-form-title">
                    <p>商品へのコメント</p>
                </div>
                <form action="/comment" method="post">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <textarea name="comment" class="comment-form-textarea"></textarea>
                    <div class="comment-form-button">
                        <button>コメントを送信する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/favorite.js') }}"></script>
@endsection