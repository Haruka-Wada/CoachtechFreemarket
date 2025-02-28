<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/common.css') }}">
    @yield('css')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <div class="header__wrapper">
            <div class="header__logo">
                <a href="/"><img src="{{ asset('img/logo.svg') }}" alt="coachtechフリマ"></a>
            </div>
            <div class="header__nav-container">
                <div class="header__search">
                    <form action="/search" method="get" class="header__search-form">
                        <input type="text" name="keyword" placeholder="なにをお探しですか?">
                    </form>
                </div>
                <div class="header__nav">
                    @if(Auth::guard('administrators')->check())
                    <div class="header__nav__item">
                        <button onclick="location.href='/admin'">管理者ページ</button>
                    </div>
                    <form action="/admin/logout" method="post" class="header__nav__item">
                        @csrf
                        <button>ログアウト</button>
                    </form>
                    @elseif(Auth()->check())
                    <form action="/logout" method="post" class="header__nav__item">
                        @csrf
                        <button>ログアウト</button>
                    </form>
                    <div class="header__nav__item">
                        <button onclick="location.href='/mypage'">マイページ</button>
                    </div>
                    <div class="header__nav__sell">
                        <button onclick="location.href='/sell'">出品</button>
                    </div>
                    @else
                    <div class="header__nav__item">
                        <button onclick="location.href='/login'">ログイン</button>
                    </div>
                    <div class="header__nav__item">
                        <button onclick="location.href='/register'">会員登録</button>
                    </div>
                    <div class="header__nav__sell">
                        <button onclick="location.href='/sell'">出品</button>
                    </div>
                    @endif
                </div>
            </div>
            <button type="button" class="nav-button" onclick="navFunc()">
            </button>
        </div>
    </header>
    <div class="main">
        @yield('main')
    </div>

    <script type="text/javascript">
        function navFunc() {
            $('.header__nav, .header__nav-container, .nav-button').toggleClass('open')
        }
    </script>
</body>

</html>