@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
    @foreach($items as $item)
    <div class="main__item">
        <form action="/item/" method="get" class="main__form">
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <button class="main__item-button">
                <img src="{{ $item->image}}" alt="{{ $item->name }}">
            </button>
        </form>
    </div>
    @endforeach
</div>
@endsection