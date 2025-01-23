@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('main')
<div class="main__container">
    <div class="main__title">
        <h2>商品の出品</h2>
    </div>
    <form action="/sell" method="post" enctype="multipart/form-data">
        @csrf
        <div class="item__contents">
            <div class="item__label">
                <p>商品画像</p>
            </div>
            <div class="item__data-file">
                <button type="button" class="upload__button">画像を選択する</button>
                <input type="file" class="item__data-upload" name="image">
            </div>
        </div>
        <div class="item__contents">
            <div class="item__headline">
                <p>商品の詳細</p>
            </div>
            <div class="item__label">
                <p>ブランド名</p>
            </div>
            <div class="item__data">
                <input type="text" class="item__data-input" name="brand">
            </div>
            <div class="item__label">
                <p>カテゴリー</p>
            </div>
            <div class="item__data">
                <div class="item__data__checkbox-toggle" id="checkbox-toggle">
                    <span>選択してください</span>
                </div>
                <div class="item__data__checkboxes" id="checkboxes">
                    @foreach($categories as $category)
                    <label class="item__data__checkbox-label">
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                        <span>{{ $category->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="item__label">
                <p>商品の状態</p>
            </div>
            <div class="item__data select">
                <select name="condition_id" id="condition">
                    <option value="" selected hidden>選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="item__contents">
            <div class="item__headline">
                <p>商品名と説明</p>
            </div>
            <div class="item__label">
                <p>商品名</p>
            </div>
            <div class="item__data">
                <input type="text" class="item__data-input" name="name">
            </div>
            <div class="item__label">
                <p>商品の説明</p>
            </div>
            <div class="item__data-textarea">
                <textarea name="description"></textarea>
            </div>
        </div>
        <div class="item__contents">
            <div class="item__headline">
                <p>販売価格</p>
            </div>
            <div class="item__label">
                <p>販売価格</p>
            </div>
            <div class="item__data price">
                <input type="number" class="item__data-input" name="price" value="" placeholder="¥">
            </div>
        </div>
        <div class="item__button">
            <button>出品する</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    document.querySelector(".upload__button").addEventListener("click", () => {
        document.querySelector(".item__data-upload").click();
    });

    $(function() {
        const checkboxToggle = document.getElementById('checkbox-toggle');
        const checkboxes = document.getElementById('checkboxes')
        checkboxToggle.addEventListener('click', function() {
            if (checkboxes.style.display == "none") {
                checkboxes.style.display = 'flex';
            } else {
                checkboxes.style.display = 'none';
            }
        })
    })
</script>

@endsection