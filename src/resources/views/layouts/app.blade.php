<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('css')
</head>


<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo">
                    FashionablyLate
                </a>
                @yield('header-button')

            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>