@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Ubah Data Teknisi</h1>
        <form action="/ubah_teknisi/{{ $teknisi->id_teknisi }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_teknisi" class="form-label">Nama Teknisi</label>
                <input type="text" class="form-control @error('nama_teknisi') is-invalid @enderror" id="nama_teknisi" name="nama_teknisi" value="{{ old('nama_teknisi', $teknisi->nama_teknisi) }}">

                @error('nama_teknisi')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="alamat">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $teknisi->alamat) }}">

                @error('alamat')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp', $teknisi->no_telp) }}">

                @error('no_telp')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Ubah!</button>
        </form>
    </div>
    <a href="/datauser" class="btn btn-primary">Kembali</a>
@endsection
