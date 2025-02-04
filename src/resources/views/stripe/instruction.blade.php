@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe/instruction.css') }}">
@endsection

@section('main')
<div class="main__container">
    <div class="main__text">
        <p>ご注文ありがとうございます！</p>
        <p>下記リンクより振込方法をご確認の上、</p>
        <p>お振込ください。</p>
        <p>ご入金の確認が取れましたら、</p>
        <p>商品を発送いたします。</p>
    </div>
    <div class="main__button">
        <form action="{{ route('checkout.session') }}" method="GET">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item_id }}">
            <input type="hidden" name="post_code" value="{{ $post_code }}">
            <input type="hidden" name="address" value="{{ $address }}">
            <input type="hidden" name="building" value="{{ $building }}">
            <input type="hidden" name="payment" value="{{ $payment }}">
            <button>振込方法はこちら</button>
        </form>
    </div>
</div>
@endsection