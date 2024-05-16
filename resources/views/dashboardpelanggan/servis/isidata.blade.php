@extends('dashboardpelanggan.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Servis</h1>
        <div class="col-lg-4 m-lg-3">
            <form action="/pelanggan/isidata" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan" id="nama_pelanggan" required value="{{ old('nama_pelanggan') }}">

                    @error('nama_pelanggan')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" required value="{{ old('alamat') }}">

                    @error('alamat')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telp</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="no_telp" required value="{{ old('no_telp') }}">

                    @error('no_telp')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required value="{{ old('email') }}">

                    @error('email')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama_konsol">Nama Konsol</label>
                    <input type="text" class="form-control @error('nama_konsol') is-invalid @enderror" id="nama_konsol" name="nama_konsol" required value="{{ old('nama_konsol') }}">

                    @error('nama_konsol')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="foto">foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">

                    @error('foto')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kendala_kerusakan">Kendala dan kerusakan</label>
                    <input type="text" class="form-control @error('kendala_kerusakan') is-invalid @enderror" id="kendala_kerusakan" name="kendala_kerusakan" required value="{{ old('kendala_kerusakan') }}">

                    @error('kendala_kerusakan')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Kirim!</button>
            </form>
            <a href="/pelanggan/daftargame">Mau request game ke konsol kamu? Klik link ini!</a>
        </div>
        <a href="/pelanggan/dashboardpelanggan" class="btn btn-primary">Kembali</a>
    </div>
@endsection
