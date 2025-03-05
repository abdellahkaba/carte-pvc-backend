<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $carte->title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100mm; /* Largeur de la carte de visite */
            height: 50mm; /* Hauteur de la carte de visite */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* Empêcher le débordement */
            /* border: 1px solid #ccc; */
        }

        .card {
            position: relative;
            width: 90mm; /* Largeur de la carte de visite */
            height: 40mm; /* Hauteur de la carte de visite */
            padding: 1mm; /* Ajuster le padding pour réduire l'espace */
            /* border: 3px solid #ccc; */
            background: linear-gradient(to right, #7ab9d3, #9fd3c7);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row; /* Affichage en ligne */
            overflow: hidden; /* Empêcher le débordement */
            margin-top: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
        }

        .logo {
            flex: 1;
            margin-right: 2mm; /* Réduire la marge */
        }

        .logo img {
            max-width: 15mm; /* Réduire la taille du logo */
            max-height: 15mm; /* Réduire la taille du logo */
        }

        .info {
            flex: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-size: 10px; /* Réduire la taille de la police */
        }

        .details p {
            margin: 0.5mm 0; /* Réduire les marges */
        }

        .details strong {
            font-size: 9px; /* Réduire la taille de la police pour les titres */
            color: #333;
        }

        .details p i {
            margin-right: 3mm; /* Réduire l'espacement des icônes */
            color: #333;
        }

        .photo {
            position: absolute;
            top: 1mm;
            right: 1mm;
        }

        .photo img {
            max-width: 15mm; /* Réduire la taille de la photo */
            max-height: 15mm; /* Réduire la taille de la photo */
            border-radius: 20%;
        }
 
        .qr {
            position: absolute;
            bottom: 3mm;
            right: 3mm;
        }

        .qr img {
            width: 10mm; /* Réduire la taille du QR code */
            height: 10mm;
        } 

        .info a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            @if(!empty($carte->logo))
                <img src="{{ $carte->logo }}" alt="Logo">
            @endif
        </div>
        <div class="info">
            <div class="details">
                @if(!empty($carte->first_name) || !empty($carte->last_name))
                    <p><strong>{{ $carte->first_name }} {{ $carte->last_name }}</strong></p>
                @endif
                @if(!empty($carte->title))
                    <p>{{ $carte->title }}</p>
                @endif
                @if(!empty($carte->phone))
                    <p><i class="fa-solid fa-phone"></i> {{ $carte->phone }}</p>
                @endif
                @if(!empty($carte->email))
                    <p><i class="fa-regular fa-envelope"></i> {{ $carte->email }}</p>
                @endif
                @if(!empty($carte->adress))
                    <p><i class="fa-solid fa-location-pin"></i> {{ $carte->adress }}</p>
                @endif
                @if(!empty($carte->website))
                    <p><i class="fa-solid fa-globe"></i> <a href="{{ $carte->website }}" target="_blank">{{ $carte->website }}</a></p>
                @endif
            </div>
        </div>
        <div class="photo">
            @if(!empty($carte->photo))
                <img src="{{ $carte->photo }}" alt="Photo">
            @endif
        </div>
        <div class="qr">
            @if(!empty($carte->qr_code))
                <img src="{{ $carte->qr_code }}" alt="QR Code">
            @endif
        </div>
    </div>
</body>
</html>
