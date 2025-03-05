<!DOCTYPE html>
<html>
<head>
    <title>Carte PVC</title>
    <style>
        .card {
            background-size: cover;
            background-position: center;
            min-height: 300px;
            padding: 20px;
            color: #fff;
        }
        .card img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <div class="card" style="background-image: url('{{ asset($carte->background_image) }}');">
        <div class="card-body">
            <h5 class="card-title">{{ $carte->title }}
                <span><img src="{{ asset($carte->logo) }}" width="50px" alt="{{ $carte->logo }}" /></span>
            </h5>
            <p class="card-text">Nom: {{ $carte->first_name }} {{ $carte->last_name }}</p>
            <p class="card-text">Email: {{ $carte->email }}</p>
            <p class="card-text">Adresse: {{ $carte->adress }}</p>
            <p class="card-text">Téléphone: {{ $carte->phone }}</p>
            <p><img src="{{ asset($carte->photo) }}" width="50px" alt="{{ $carte->photo }}" /></p>
            <p><img src="{{ asset($carte->qr_code) }}" width="50px" alt="{{ $carte->qr_code }}" /></p>
        </div>
    </div>
</body>
</html>