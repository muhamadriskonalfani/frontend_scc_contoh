<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Career Center')</title>

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

        /* CENTER SCREEN (DESKTOP) */
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
            overflow-x: hidden;
        }

        /* HEADER SPACE */
        .mobile-header {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* CONTENT */
        .mobile-content {
            padding-bottom: 70px;
            color: var(--text-dark);
        }

        /* BOTTOM NAV */
        .bottom-nav {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            height: 60px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: var(--white);
            border-top: 1px solid var(--border);
            z-index: 1000;
        }

        .bottom-nav a {
            text-decoration: none;
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .bottom-nav a i {
            width: 20px;
            height: 20px;
        }

        .bottom-nav a.active {
            color: var(--blue);
            font-weight: 500;
        }

        .bottom-nav a.active i {
            stroke-width: 2.2px;
        }

        /* REAL MOBILE */
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
            <header class="mobile-header">
                @yield('header')
            </header>
        @endif

        {{-- CONTENT --}}
        <main class="mobile-content">
            @yield('content')
        </main>

        {{-- FOOTER / BOTTOM NAV --}}
        @hasSection('footer')
            @yield('footer')
        @else
            <nav class="bottom-nav">

                <a href="{{ route('dashboard.index') }}"
                   class="{{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <i data-feather="home"></i>
                    <span>Beranda</span>
                </a>

                <a href="{{ route('tracer_study.index') }}"
                   class="{{ request()->routeIs('tracer_study.*') ? 'active' : '' }}">
                    <i data-feather="activity"></i>
                    <span>Tracer</span>
                </a>

                <a href="{{ route('dashboard.career_info') }}"
                   class="{{ request()->routeIs('job_vacancy.*') ? 'active' : '' }}">
                    <i data-feather="briefcase"></i>
                    <span>Karir</span>
                </a>

                <a href="{{ route('campus.info.index') }}"
                   class="{{ request()->routeIs('campus.*') ? 'active' : '' }}">
                    <i data-feather="book-open"></i>
                    <span>Kampus</span>
                </a>

                <a href="{{ route('profile.index') }}"
                   class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i data-feather="user"></i>
                    <span>Akun</span>
                </a>

            </nav>
        @endif

    </div>

    <script>
        feather.replace();
    </script>

    @yield('scripts')
</body>
</html>
