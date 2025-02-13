@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('main')
<div class="main__container">
    <div class="item__wrapper image__wrapper">
        <div class="item__image" data-purchased="{{ $item->is_purchased }}">
            <img src="{{ $item->image }}" alt="{{ $item->name }}">
            <span></span>
        </div>
    </div>
    <div class="item__wrapper">
        <div class="item__detail">
            <div class="item__name">
                <h1>{{ $item->name }}</h1>
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
                    <img class="like-toggle" src="{{ asset('img/star.jpeg')}}" data-item-id="{{ $item->id }}" alt="お気に入り">
                    <p class="item__icon-star__counter">{{ $item->favorites_count }}</p>
                </div>
                @else
                <div class="item__icon-star">
                    <img class="like-toggle liked" data-item-id="{{ $item->id }}" src="{{ asset('img/yellow_star.jpeg')}}" alt="お気に入り">
                    <p class="item__icon-star__counter">{{ $item->favorites_count }}</p>
                </div>
                @endif
                @endauth
                @guest
                <div class="item__icon-star">
                    <form action="/favorite" method="post">
                        @csrf
                        <button>
                            <img class="item__icon-star__button" src="{{ asset('img/star.jpeg')}}" alt="お気に入り">
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
            @if($item->is_purchased === 1)
            <div class="item__purchase sold">
                <button>sold out</button>
            </div>
            @else
            <div class="item__purchase">
                <form action="/purchase/" method="get">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button>購入する</button>
                </form>
            </div>
            @endif
            <div class="item__index">
                <h2>商品説明</h2>
            </div>
            <div class="item__text">
                <p>{!! nl2br(e($item->description)) !!}</p>
            </div>
            <div class="item__index">
                <h2>商品の情報</h2>
            </div>
            <div class="item__label">
                <div class="item__label-index">
                    <h3>カテゴリー</h3>
                </div>
                <div class="item__label-category">
                    @foreach($item->categories as $category)
                    <p>{{ $category->name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="item__label">
                <h3>商品の状態</h3>
                <p class="item__label-condition">{{ $item->condition->name }}</p>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/favorite.js') }}"></script>
<script src="{{ asset('js/purchased.js') }}"></script>
@endsection