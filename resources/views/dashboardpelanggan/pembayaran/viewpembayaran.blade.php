<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css") }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pembayaran</title>
</head>
<body>
    <div class="container-fluid">
        <!-- Navigation-->
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

        <h1>Halaman Pembayaran</h1>

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Form Pembayaran</h5>
                <p class="card-text">Silahkan isi form berikut</p>
                    @foreach ($pelanggan as $d)
                    <form action="/pelanggan/bayar" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $d->id_pelanggan }}" name="id_pelanggan">
                        @endforeach
                        @foreach ($antrian as $c)
                            <input type="hidden" value="{{ $c->id_antrian }}" name="id_antrian">
                        @endforeach
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pelanggam</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda!">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Anda!">
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No. Telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No. Telp Anda!">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                            <input type="number" class="form-control" id="jumlah_pembayaran" name="jumlah_pembayaran" placeholder="Masukkan jumlah pembayaran">
                        </div>
                        <button class="btn btn-primary">Bayar!</button>
                    </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js") }}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="{{ asset("js/scripts.js") }}"></script>
</body>
</html>
