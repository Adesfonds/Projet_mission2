<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Mon Site')</title>

</head>
<body>

<!-- Menu inclus sur toutes les pages -->
@include('menu')

<!-- Contenu spécifique de chaque page -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
