@extends('dashboard.layouts.main')

@section('container')
    <div class="card-shadow">
        @foreach ($profilToko as $toko)
        <img src="{{ asset($toko->foto) }}" class="rounded mx-auto d-block" alt="..." width="500px" height="300px">
        <div class="card-body">
               <p>Nama Toko: {{ $toko->nama_toko }}</p>
               <p>Deskripsi Toko: {{ $toko->deskripsi }}</p>
               <a href="/ubahprofilToko/{{ $toko->id_toko }}" class="btn btn-primary row-cols-4">Ubah!</a>
        </div>
        <br>
        @endforeach
        <a href="/dashboard" class="btn btn-primary">Kembali</a>
    </div>
@endsection
