<!DOCTYPE html>
<html>
<head>
    <title>{{ $carte->title }}</title>
    <style>
        @font-face {
            font-family: 'FontAwesome';
            src: url('{{ storage_path("fonts/fa-v4compatibility.woff2") }}') format('woff2');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 350px;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            display: grid;
            grid-template-areas: 
                "logo title photo"
                "info info info"
                "qr qr qr";
            grid-template-columns: 1fr 2fr 1fr;
            grid-gap: 10px;
        }
        .logo {
            grid-area: logo;
            text-align: left;
        }
        .title {
            grid-area: title;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }
        .photo {
            grid-area: photo;
            text-align: right;
        }
        .info {
            grid-area: info;
            text-align: left;
            font-size: 12px;
        }
        .qr {
            grid-area: qr;
            text-align: right;
            margin-top: 10px;
        }
        .card img {
            border-radius: 5px;
        }
        .card .photo img {
            border-radius: 50%;
        }
        .card a {
            color: #007bff;
            text-decoration: none;
            font-size: 12px;
        }
        .card a:hover {
            text-decoration: underline;
        }
        .fa-phone {
            font-family: 'FontAwesome';
            margin-right: 5px;
        }
        .fa-user {
            font-family: 'FontAwesome';
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            @if(!empty($carte->logo))
                <img src="{{ $carte->logo }}" width="50px" alt="Logo">
            @endif
        </div>
        <div class="title">
            {{ $carte->title }}
        </div>
        <div class="photo">
            @if(!empty($carte->photo))
                <img src="{{ $carte->photo }}" width="50px" alt="Photo">
            @endif
        </div>
        <div class="info">
            @if(!empty($carte->first_name) || !empty($carte->last_name))
                <p><strong>{{ $carte->first_name }} {{ $carte->last_name }}</strong></p>
            @endif
            @if(!empty($carte->job_title))
                <p>{{ $carte->job_title }}</p>
            @endif
            @if(!empty($carte->phone))
                <p><i class="fa fa-phone"></i> Téléphone: {{ $carte->phone }}</p>
            @endif
            @if(!empty($carte->email))
                <p><i class="fa fa-user"></i> Email: {{ $carte->email }}</p>
            @endif
            @if(!empty($carte->adress))
                <p>Adresse: {{ $carte->adress }}</p>
            @endif
            @if(!empty($carte->website))
                <p>Site Web: <a href="{{ $carte->website }}" target="_blank">{{ $carte->website }}</a></p>
            @endif
        </div>
        <div class="qr">
            @if(!empty($carte->qr_code))
                <img src="{{ $carte->qr_code }}" width="50px" alt="QR Code">
            @endif
        </div>
    </div>
</body>
</html>






















<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $carte->title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex; 
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 700px;
            height: 350px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(to right, #66a6ff, #89f7fe);
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 20px;
        }
        .logo, .photo, .qr {
            display: flex;
            align-items: center;
        }
        .logo img {
            width: 100px;
            height: auto;
        }
        .title {
            flex-grow: 1;
            font-size: 24px;
            font-weight: bold;
            color: #0d47a1;
        }
        .photo img {
            width: 100px;
            height: 100px;
            border-radius: 10%;
        }
        .info {
            flex-grow: 2;
            font-size: 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #000;
        }
        .info strong {
            font-size: 24px;
            color: #000;
        }
        .info p {
            margin: 5px 0;
            display: flex;
            align-items: center;
        }
        .info i {
            margin-right: 10px;
        }
        .qr img {
            width: 150px;
            height: auto;
        }
        .card a {
            color: #007bff;
            text-decoration: none;
        }
        .card a:hover {
            text-decoration: underline;
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
        <div class="title">
            Groupe Digital Dounia
        </div>
        <div class="photo">
            @if(!empty($carte->photo))
                <img src="{{ $carte->photo }}" alt="Photo">
            @endif
        </div>
        <div class="info">
            @if(!empty($carte->first_name) || !empty($carte->last_name))
                <p><strong>{{ $carte->first_name }} {{ $carte->last_name }}</strong></p>
            @endif
            @if(!empty($carte->job_title))
                <p>{{ $carte->job_title }}</p>
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
        <div class="qr">
            @if(!empty($carte->qr_code))
                <img src="{{ $carte->qr_code }}" alt="QR Code">
            @endif
        </div>
    </div>
</body>
</html>





{{-- Je garde ca aussi ici --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $carte->title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
        }

        .card {
            position: relative;
            width: 500px;
            height: 230px;
            padding: 10px;
            border: 1px solid #ccc;
            background: linear-gradient(to right, #7ab9d3, #9fd3c7);
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .logo img {
            max-width: 80px;
        }

        .photo {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .photo img {
            max-width: 80px;
            border-radius: 50%;
        }

        .info {
            position: absolute;
            top: 120px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .details {
            flex: 1;
        }

        .details p {
            margin: 3px 0;
        }

        .details strong {
            font-size: 1.2em;
            color: #333;
        }

        .details p i {
            margin-right: 10px;
            color: #333;
        }

        .qr {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .qr img {
            width: 60px;
            height: 60px;
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
        <div class="photo">
            @if(!empty($carte->photo))
                <img src="{{ $carte->photo }}" alt="Photo">
            @endif
        </div>
        <div class="info">
            <div class="details">
                @if(!empty($carte->first_name) || !empty($carte->last_name))
                    <p><strong>{{ $carte->first_name }} {{ $carte->last_name }}</strong></p>
                @endif
                @if(!empty($carte->job_title))
                    <p>{{ $carte->job_title }}</p>
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
        <div class="qr">
            @if(!empty($carte->qr_code))
                <img src="{{ $carte->qr_code }}" alt="QR Code">
            @endif
        </div>
    </div>
</body>
</html>

