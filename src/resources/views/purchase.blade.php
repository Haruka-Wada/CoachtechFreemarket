@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('main')
<div class="main__container">
    <div class="main__wrapper">
        <div class="item__container">
            <div class="item__image">
                <img src="{{ $item->image }}" alt="{{ $item->name }}">
            </div>
            <div class="item__detail">
                <div class="item__detail-name">
                    <h2>{{ $item->name }}</h2>
                </div>
                <div class="item__detail-price">
                    <p>¥{{ number_format($item->price) }}</p>
                </div>
            </div>
        </div>
        <div class="item__form">
            <div class="form__label-payment">
                <p>支払い方法</p>
                <select name="payment">
                    <option disabled selected>選択してください</option>
                    <option value="card">クレジットカード</option>
                    <option value="convenience_store">コンビニ</option>
                    <option value="bank">銀行振込</option>
                </select>
            </div>
            <div class="form__label-purchase">
                <p>配送先</p>
                <form action="/purchase/address" method="get">
                    <input type="hidden" method="get" name="item_id" value="{{ $item->id }}">
                    <button>変更する</button>
                </form>
            </div>
            <div class="form__address">
                <p>{{ Auth::user()->post_code }}</p>
                <p>{{ Auth::user()->address }} {{ Auth::user()->building }}</p>
                @if(!Auth::user()->post_code || !Auth::user()->address)
                <p>配送先を変更してください</p>
                @endif
            </div>
        </div>
    </div>
    <div class="purchase__wrapper">
        <div class="purchase__contents">
            <div class="purchase__label price">
                <p class="purchase__label-index">商品代金</p>
                <p class="purchase__label-item">¥{{ number_format($item->price) }}</p>
            </div>
            <div class="purchase__label">
                <p class="purchase__label-index">支払い金額</p>
                <p class="purchase__label-item">¥{{ number_format($item->price) }}</p>
            </div>
            <div class="purchase__label">
                <p class="purchase__label-index">支払い方法</p>
                <p class="purchase__label-item" id="payment"></p>
            </div>
        </div>
        <div class="purchase__button">
            <form action="{{ route('checkout.session') }}" method="GET">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <button class="purchase__button-btn">購入する</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        const payment = $('#payment');
        $('[name=payment]').change(function() {
            const selectedPayment = $('[name=payment] option:selected').text();
            payment.text(selectedPayment);
        })
    })
</script>
@endsection