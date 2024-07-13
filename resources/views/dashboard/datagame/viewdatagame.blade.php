@extends('dashboard.layouts.main')

@section('container')
<form action="/carigame" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari game..." aria-label="Cari game" name="cariGame" value="{{ request('cariGame') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari game</button>
            </div>
        </form>
        <br>
        <a href="/tambahgame" class="btn btn-primary">Tambah Game</a>
        <br>
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Game</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Game</th>
                                            <th>Nama Game</th>
                                            <th>Tanggal Rilis</th>
                                            <th>Platform</th>
                                            <th>Foto</th>
                                            <th>Developer</th>
                                            <th>Ubah</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($game as $item)
                                        <tr>
                                            <td>{{ $item->id_game }}</td>
                                            <td>{{ $item->nama_game }}</td>
                                            <td>{{ $item->tgl_rilis }}</td>
                                            <td>{{ $item->platform }}</td>
                                            <td><img src="{{ asset($item->foto) }}" width="130px" height="200px"></td>
                                            <td>{{ $item->developer }}</td>
                                            <td><a href="/ubahGame/{{ $item->id_game }}" class="badge btn btn-warning"><img src="{{ asset('images/edit.png') }}" alt="edit" width="60px" height="60px"></a></td>
                                            <td>
                                                <form action="/hapusGame/{{ $item->id_game }}" class="d-inline" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge border-0" onclick="return confirm('Yakin mau hapus data ini?')"><img src="{{ asset('images/delete.png') }}" alt="" width="60px" height="60px"></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $game->links() }}
                    </div>
                    <a href="/dashboard" class="btn btn-primary">Kembali</a>
@endsection
