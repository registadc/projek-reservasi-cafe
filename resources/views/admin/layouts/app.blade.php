<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/templatemo-glass-admin-style.css') }}">

</head>
<body>

    <!-- Background -->
    <div class="background"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="dashboard">

        @include('admin.layouts.sidebar')

        <main class="main-content">

            @include('admin.layouts.navbar')

            @yield('content')

        </main>
    </div>

    <footer class="site-footer">
        <p>Copyright © 2026 Giee Cafe</p>
    </footer>

    <script src="{{ asset('template/templatemo-glass-admin-script.js') }}"></script>
</body>
</html>