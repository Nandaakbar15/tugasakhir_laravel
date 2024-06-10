@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Tambah Teknisi</h1>

        <div class="col-lg-4 m-lg-3">
            <form action="/tambahTeknisi" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="nama_teknisi" class="form-label">Nama Teknisi</label>
                    <input type="text" class="form-control @error('nama_teknisi') is-invalid @enderror" name="nama_teknisi" id="nama_teknisi" required value="{{ old('nama_teknisi') }}">

                    @error('nama_teknisi')
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
                <button type="submit" class="btn btn-primary">Tambah!</button>
            </form>
        </div>
    </div>
    <a href="/datauser" class="btn btn-primary">Kembali</a>
@endsection
