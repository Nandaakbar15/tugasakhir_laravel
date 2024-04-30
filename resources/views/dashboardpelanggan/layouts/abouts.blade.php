<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css") }}">
    <title>Playstation Games</title>
</head>
<body>

    <div class="container-fluid">
        <h1>Profil Toko</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/pelanggan/dashboardpelanggan">Playstation Games</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" href="/pelanggan/dashboardpelanggan">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pelanggan/profilToko">Profil Toko</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pelanggan/statusservis">Status Servis</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pelanggan/pembayaran">Bayar</a></li>
                    </ul>
                    <a href="/logout" class="d-flex">Logout</a>
                </div>
            </div>
        </nav>

        <div class="card-shadow">
            <img src="{{ asset($profiltoko->foto) }}" class="rounded mx-auto d-block" alt="..." width="500px" height="300px">
            <div class="card-body">
             @foreach ($profilToko as $toko)
                <p>Nama Toko: {{ $toko->nama_toko }}</p>
                <p>Deskripsi Toko: {{ $toko->deskripsi }}</p>
                <a href="/pelanggan/dashboardpelanggan" class="btn btn-primary">Kembali</a>
            </div>
            <br>
        @endforeach
    </div>
    </div>

    <script src="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css") }}"></script>
</body>
</html>
