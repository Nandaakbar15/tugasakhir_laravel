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
            @foreach ($pelanggan as $data)
                <label for="email" class="form-label">Email Pelanggan</label>
                <select name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                    <option value="{{ $data->email }}">{{ $data->email }}</option>
                </select>
                @error('email')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            @endforeach
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>
                Terimakasih sudah menggunakan layanan kami, untuk selanjutnya dimohon untuk
                membawa konsol anda setelah itu proses perbaikan konsol akan kami lakukan.
            </textarea>
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
