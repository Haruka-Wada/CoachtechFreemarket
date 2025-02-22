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
            <div class="error">
                @error('image')
                {{ $message }}
                @enderror
            </div>
            <div class="item__data-file">
                <button type="button" class="upload__button">画像を選択する</button>
                <input type="file" class="item__data-upload" name="image">
            </div>
            <div class="item__data-file__preview">
                <img id="preview" src="" alt="">
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
                <input type="text" class="item__data-input" name="brand" value="{{ old('brand') }}">
            </div>
            <div class="item__label">
                <p>カテゴリー</p>
            </div>
            <div class="error">
                @error('category_ids')
                {{ $message }}
                @enderror
            </div>
            <div class="item__data">
                <div class="item__data__checkbox-toggle" id="checkbox-toggle">
                    <span>選択してください</span>
                </div>
                <div class="item__data__checkboxes" id="checkboxes" style="display: none;">
                    @foreach($categories as $category)
                    <label class="item__data__checkbox-label">
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" {{ in_array($category->id, (array)old('category_ids')) ? 'checked' : '' }}>
                        <p>{{ $category->name }}</p>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="item__label">
                <p>商品の状態</p>
            </div>
            <div class="error">
                @error('condition')
                {{ $message }}
                @enderror
            </div>
            <div class="item__data select">
                <select name="condition_id" id="condition">
                    <option value="" selected hidden>選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}" @if(old('condition_id')==$condition->id) selected @endif>{{ $condition->name }}</option>
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
            <div class="error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="item__data">
                <input type="text" class="item__data-input" name="name" value="{{ old('name') }}">
            </div>
            <div class="item__label">
                <p>商品の説明</p>
            </div>
            <div class="error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
            <div class="item__data-textarea">
                <textarea name="description">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="item__contents">
            <div class="item__headline">
                <p>販売価格</p>
            </div>
            <div class="item__label">
                <p>販売価格</p>
            </div>
            <div class="error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
            <div class="item__data price">
                <input type="text" class="item__data-input" name="price" value="{{ old('price') }}" placeholder="¥">
            </div>
        </div>
        <div class="item__button">
            <button>出品する</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    // 画像選択ボタンクリック時にファイル選択画面へ移行する
    document.querySelector(".upload__button").addEventListener("click", () => {
        document.querySelector(".item__data-upload").click();
    });

    // ファイル選択後のプレビュー表示
    const fileInput = document.querySelector("input[type=file]");
    fileInput.addEventListener("change", function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $("#preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    // カテゴリー選択のチェックボックス表示
    $(function() {
        const checkboxToggle = document.getElementById('checkbox-toggle');
        const checkboxes = document.getElementById('checkboxes');
        checkboxToggle.addEventListener('click', function() {
            if (checkboxes.style.display == "none") {
                checkboxes.style.display = 'flex';
            } else {
                checkboxes.style.display = 'none';
            }
        });
    });

    //　カテゴリーチェック時の表示
    $(function() {
        var label;
        $('input[type="checkbox"]').on("change", function() {
            $("span:contains(選択してください)").remove();
            label = $(this).next().text();
            if ($(this).is(":checked")) {
                $("#checkbox-toggle").append("<span>" + label + "</span>");
            } else {
                $("span:contains(" + label + ")").remove();
            }
        })
    });

    $('input:checked').each(function() {
        let label = $(this).next().text();
        console.log(label);
        $("span:contains(選択してください)").remove();
        $("#checkbox-toggle").append("<span>" + label + " </span>");
    });
</script>

@endsection