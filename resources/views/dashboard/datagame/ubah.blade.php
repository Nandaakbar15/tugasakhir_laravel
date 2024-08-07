@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1>Ubah Game</h1>
        <input type="hidden" name="gambarLama" value="{{ $game_request->foto }}">
        <form action="/ubahGame/{{ $game_request->id_game }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_game" class="form-label">Nama Game</label>
                <input type="text" class="form-control @error('nama_game') is-invalid @enderror" id="nama_game" name="nama_game" autofocus value="{{ old('nama_game', $game_request->nama_game) }}">

                @error('nama_game')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tgl_rilis" class="form-label">Tanggal Rilis</label>
                <input type="date" class="form-control @error('tgl_rilis') is-invalid @enderror" id="tgl_rilis" name="tgl_rilis" autofocus value="{{ old('tgl_rilis', $game_request->tgl_rilis) }}">

                @error('tgl_rilis')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="platform">Platform</label>
                <input type="text" class="form-control @error('platform') is-invalid @enderror" id="platform" name="platform" required value="{{ old('platform', $game_request->platform) }}">

                @error('platform')
                    <div class="is-invalid">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="developer">Developer</label>
                <input type="text" class="form-control @error('developer') is-invalid @enderror" id="developer" name="developer" required value="{{ old('developer', $game_request->developer) }}">

                @error('developer')
                    {{ $message }}
                @enderror
            </div>
            <div class="mb-3">
                @if ($game_request->foto)
                    <img src="{{ asset($game_request->foto) }}" alt="" width="300px" height="200px">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <div class="img-preview">
                    <label class="form-label" for="foto">foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto" onchange="previewImage()">

                    @error('foto')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-4">ubah!</button>
        </form>
    </div>

    <script text="text/javascript">
        function previewImage() {
            const foto = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
</script>

    <a href="/datagame" class="btn btn-primary">Kembali</a>
@endsection
