<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte de Visite</title>
</head>
<body>
    <h1>Carte de Visite de {{ $carte->name }}</h1>
    <img src="{{ asset('qrcodes/' . $carte->qr_code) }}" alt="QR Code" />
    <p><a href="{{ $carte->website }}">Site Web</a></p>
    <p><a href="{{ $carte->social_links }}">Réseaux Sociaux</a></p>
    <p>Téléphone: {{ $carte->phone }}</p>
    <p>Email: {{ $carte->email }}</p>
    {{-- <p><a href="/login">Se Connecter</a></p> --}}
</body>
</html>