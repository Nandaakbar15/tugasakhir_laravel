@extends('dashboardpelanggan.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Servis</h1>
        <div class="col-lg-4 m-lg-3">
            <form action="/pelanggan/isidata" enctype="multipart/form-data" method="POST" id="pelangganform">
            @csrf
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan" id="nama_pelanggan" required value="{{ $nama_pelanggan }}">

                    @error('nama_pelanggan')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" required value="{{ $alamat }}">

                    @error('alamat')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telp</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="no_telp" required value="{{ $no_telp}}">

                    @error('no_telp')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required value="{{ $email }}">

                    @error('email')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama_konsol">Nama Konsol</label>
                    <input type="text" class="form-control @error('nama_konsol') is-invalid @enderror" id="nama_konsol" name="nama_konsol" required value="{{ $nama_konsol }}">

                    @error('nama_konsol')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="foto">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" required value="{{ $foto }}">

                    @error('foto')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kendala_kerusakan">Kendala dan kerusakan</label>
                    <input type="text" class="form-control @error('kendala_kerusakan') is-invalid @enderror" id="kendala_kerusakan" name="kendala_kerusakan" required value="{{ $kendala_kerusakan }}">

                    @error('kendala_kerusakan')
                        <div class="is-invalid">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Kirim!</button>
            </form>
            <a href="/pelanggan/daftargame">Mau request game ke konsol kamu? Klik link ini!</a>
            <table class="table table-primary table-striped-columns">
                <thead>
                    <tr>
                        <th>Id Game</th>
                        <th>Nama Game</th>
                        <th>Developer</th>
                        <th>Tanggal Rilis</th>
                        <th>Platform</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (session('game'))
                        @foreach (session('game') as $item)
                        <tr>
                            <td>{{ $item['id_game'] }}</td>
                            <td>{{ $item['nama_game'] }}</td>
                            <td>{{ $item['developer'] }}</td>
                            <td>{{ $item['tgl_rilis'] }}</td>
                            <td>{{ $item['platform'] }}</td>
                            <td><img src="{{ asset($item['foto']) }}" width="100px" height="80px"></td>
                            <td>
                                <form action="/pelanggan/deleteList" class="d-inline" method="POST">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id_game" value="{{ $item['id_game'] }}">
                                    <button class="badge border-0" onclick="return confirm('Yakin mau hapus game dari list?')"><img src="{{ asset('images/delete.png') }}" alt="" width="60px" height="40px"></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Belum ada game yang ada di list</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <a href="/pelanggan/dashboardpelanggan" class="btn btn-primary">Kembali</a>
    </div>
@endsection
