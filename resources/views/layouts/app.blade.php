<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Network Monitor')</title>

    <!-- Lien vers notre fichier CSS (dans public/css/styles.css) -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Dans resources/views/layouts/app.blade.php, par exemple, dans le <head> ou tout en bas du <body> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="app-container">
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>
