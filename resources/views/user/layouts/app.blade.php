<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('template/templatemo-glass-admin-style.css') }}">

</head>

<body>

    @include('user.layouts.navbar')

    <main class="main-content">
        @yield('content')
    </main>

    <script src="{{ asset('template/templatemo-glass-admin-script.js') }}"></script>

    @stack('scripts')
    
</body>
</html>