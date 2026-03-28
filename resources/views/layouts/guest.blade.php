<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EnzoPrestige</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('layouts.navigation')

<main class="page-section">
    <div class="container" style="max-width: 520px;">
        <div class="card">
            {{ $slot }}
        </div>
    </div>
</main>
</body>
</html>
