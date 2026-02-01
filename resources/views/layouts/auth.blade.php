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
            --white: #ffffff;
            --blue-light: #eaf3ff;
            --blue: #3578c3;
            --blue-dark: #2b64a8;
            --border: #e5e7eb;
            --text-dark: #374151;
            --text-muted: #6b7280;
        }

        /* CENTER SCREEN */
        body {
            margin: 0;
            min-height: 100vh;
            background: #eaeaea;
            display: flex;
            justify-content: center;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        /* MOBILE CANVAS */
        .mobile-wrapper {
            width: 360px;
            min-height: 100vh;
            background: linear-gradient(
                180deg,
                #ffffff 0%,
                var(--blue-light) 100%
            );
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,.15);
        }

        /* CONTENT */
        .mobile-content {
            padding-bottom: env(safe-area-inset-bottom);
        }

        /* RESPONSIVE REAL HP */
        @media (max-width: 420px) {
            body {
                justify-content: flex-start;
            }

            .mobile-wrapper {
                width: 100%;
                box-shadow: none;
            }
        }
    </style>

    @yield('styles')
    @vite(['resources/js/app.js'])
</head>
<body>

    <div class="mobile-wrapper">

        {{-- HEADER --}}
        @hasSection('header')
            @yield('header')
        @endif

        {{-- CONTENT --}}
        <main class="mobile-content">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        @hasSection('footer')
            @yield('footer')
        @endif

    </div>

    <script>
        feather.replace();
    </script>

    @yield('scripts')
</body>
</html>
