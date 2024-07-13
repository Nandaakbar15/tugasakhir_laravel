@extends('dashboardpelanggan.layouts.main')

@section('container')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($game as $item)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset($item->foto) }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $item->nama_game }}</h5>
                                    <!-- Product price-->
                                    {{ $item->platform }}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <form action="/pelanggan/tambahGame" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_game" value="{{ $item->id_game }}">
                                        <button type="submit" class="btn btn-outline-dark mt-auto">Tambah ke list!</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $game->links() }}
            </div>
            <a href="/pelanggan/servis" class="btn btn-primary">Kembali</a>
        </div>
    </section>
@endsection
