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
                    <h1>{{ $item->name }}</h1>
                </div>
                <div class="item__detail-price">
                    <p>¥{{ number_format($item->price) }}</p>
                </div>
            </div>
        </div>
        <div class="item__form">
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <div class="form__label-payment">
                <h2>支払い方法</h2>
                <select name="payment">
                    <option disabled selected>選択してください</option>
                    <option value="card">クレジットカード</option>
                    <option value="konbini">コンビニ</option>
                    <option value="customer_balance">銀行振込</option>
                </select>
            </div>
            <div class="form__label-purchase">
                <h2>配送先</h2>
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
        @if (count($errors) > 0)
        <ul class="error">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
        <div class="purchase__button">
            <form action="{{ route('checkout.session') }}" method="GET">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" name="post_code" value="{{ Auth::user()->post_code }}">
                <input type="hidden" name="address" value="{{ Auth::user()->address }}">
                <input type="hidden" name="building" value="{{ Auth::user()->building }}">
                <input type="hidden" name="payment" value="">
                <button class="purchase__button-btn">購入する</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        const payment = $('#payment');
        $('select').change(function() {
            const selectedPayment = $('[name=payment] option:selected').html();
            const paymentValue = $('[name=payment] option:selected').val();
            payment.text(selectedPayment);
            $('input[name="payment"]').val(paymentValue);
        })

    })
</script>
@endsection