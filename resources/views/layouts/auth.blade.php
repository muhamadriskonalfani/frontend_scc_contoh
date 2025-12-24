<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        :root {
            --fresh-orange: #ff5722;
            --white-body: #f5f5f5;
            --white-box: #fff;
            --red-notif: #f00;
            --border: #e6e6e6;
        }

        body {
            background: var(--white-box);
            padding-top: 60px;
            padding-bottom: 65px;
            color: #333;
        }
    </style>

    @yield('styles')
    @vite(['resources/js/app.js'])
</head>
<body>

    {{-- HEADER --}}
    <div class="p-0">
        @yield('header')
    </div>

    {{-- CONTENT --}}
    <div class="p-0">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <div class="p-0">
        @yield('footer')
    </div>

    <script>
        feather.replace();
    </script>

    @yield('scripts')
</body>
</html>
