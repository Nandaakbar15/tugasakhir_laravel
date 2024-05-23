@extends('dashboard.layouts.main')

@section('container')
    <h1>Kirim Pesan ke Pelanggan</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="/kirim-notifikasi" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Pelanggan</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
            @error('email')
                <div class="is-invalid">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required></textarea>
            @error('message')
                <div class="is-invalid">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    <a href="/dashboard" class="btn btn-primary mt-3">Kembali</a>
@endsection
