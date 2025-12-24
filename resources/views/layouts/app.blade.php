<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Marketplace')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        :root {
            --fresh-orange: #ff5722;
            --fresh-blue: #2243ff;
            --white-body: #f5f5f5;
            --white-box: #fff;
            --red-notif: #f00;
            --border: #e6e6e6;
        }

        body {
            background: var(--white-body);
            padding-top: 60px;
            padding-bottom: 65px;
        }

        .bottom-nav {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 58px;
            background: var(--white-box);
            border-top: 1px solid var(--border);
            z-index: 1000;
        }

        .bottom-nav a {
            text-decoration: none;
            color: #777;
            font-size: 12px;
        }

        .bottom-nav a.active {
            color: var(--fresh-orange);
        }
    </style>

    @yield('styles')
    @vite(['resources/js/app.js'])
</head>
<body>
    <!-- TOP HEADER -->
    <div class="p-0">
        @yield('header')
    </div>

    <!-- PAGE CONTENT -->
    <div class="p-0">
        @yield('content')
    </div>

    <!-- BOTTOM NAV -->
    <div class="p-0">
        @if(View::hasSection('footer'))
            @yield('footer')
        @else
            <div class="bottom-nav p-0">

                <a href="#" class="text-center">
                    <i data-feather="home"></i>
                    <div>Beranda</div>
                </a>

                <a href="#" class="text-center">
                    <i data-feather="trending-up"></i>
                    <div>Trending</div>
                </a>

                <a href="#" class="text-center">
                    <i data-feather="shopping-bag"></i>
                    <div>Market</div>
                </a>

                <a href="#" class="text-center">
                    <i data-feather="bell"></i>
                    <div>Notif</div>
                </a>

                <a href="#" class="text-center">
                    <i data-feather="user"></i>
                    <div>Akun</div>
                </a>

            </div>
        @endif
    </div>

    <script>
        feather.replace();
    </script>

    @yield('scripts')
</body>
</html>
