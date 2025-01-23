@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
@endsection

@section('main')
<div class="main__container">
    <div class="main__text">
        <p>決済成功です！</p>
    </div>
</div>
@endsection