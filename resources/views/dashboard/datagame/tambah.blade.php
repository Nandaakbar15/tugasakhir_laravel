@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Tambah Game</h1>
        <form action="/tambahgame" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_game" class="form-label">Nama Game</label>
                <input type="text" class="form-control @error('nama_game') is-invalid @enderror" id="nama_game" name="nama_game" required value="{{ old('nama_game') }}">

                @error('nama_game')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="developer">Developer</label>
                <input type="text" class="form-control @error('developer') is-invalid @enderror" id="developer" name="developer" required value="{{ old('developer') }}">

                @error('developer')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                <label for="tgl_rilis" class="form-label">Tanggal Rilis</label>
                <input type="date" class="form-control @error('tgl_rilis') is-invalid @enderror" id="tgl_rilis" name="tgl_rilis" required value="{{ old('tgl_rilis') }}">

                @error('tgl_rilis')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="platform">Platform</label>
                <input type="text" class="form-control @error('platform') is-invalid @enderror" id="platform" name="platform" required value="{{ old('platform') }}">

                @error('platform')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="foto">foto</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" required accept="image/*">

                @error('foto')
                    {{ $message }}
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">tambah!</button>
        </form>
        <div class="mb-3"></div>
        <a href="/dashboard" class="btn btn-primary">Kembali</a>
    </div>
@endsection
