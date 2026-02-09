
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
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
