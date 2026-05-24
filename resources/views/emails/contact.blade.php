<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Nouveau message de contact</h2>

<p><strong>Nom :</strong> {{ $nom }}</p>
<p><strong>Email :</strong> {{ $email }}</p>
<p><strong>Sujet :</strong> {{ $subject }}</p>

<hr>

<p><strong>Message :</strong></p>
<p>{{ $contenu }}</p>  {{-- ← 'message' renommé en 'contenu' --}}
</body>
</html>
