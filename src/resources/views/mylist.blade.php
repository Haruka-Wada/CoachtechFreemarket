@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mylist.css') }}">
@endsection

@section('main')
<ul id="tab" class="tab">
    <li class="recommend">
        <a href="/">おすすめ</a>
    </li>
    <li class="mylist">
        <a href="/mylist">マイリスト</a>
    </li>
</ul>

<div class="main__container">
    @foreach($favorites as $favorite)
    <div class="main__item">
        <form action="/item/" method="get" class="main__form">
            <input type="hidden" name="item_id" value="{{ $favorite->item->id }}">
            <button class="main__item-button">
                <img src="{{ $favorite->item->image}}" alt="{{ $favorite->item->name }}">
            </button>
        </form>
    </div>
    @endforeach
</div>
@endsection