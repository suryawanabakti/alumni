@extends('components.layouts.master')
@section('content')
    <div class="flex-grow-1">
        <section class="text-white position-relative d-flex flex-column align-items-center justify-content-center"
            id="hero">
            <div class="position-relative z-1 container" id="hero-content">
                <h1 class="mb-3" data-aos="fade-down">Selamat Datang
                    <br class="d-none d-sm-inline">Alumni Universitas Teknologi Akba
                </h1><!-- Set default value-->
                <form class="d-flex gap-2" role="search" action="/login">

                    <button class="btn btn-primary d-flex gap-2" type="submit"><i class="bi-person"></i>Masuk</button>


                </form>
            </div>
            <picture class="position-absolute z-0 pe-none">
                <source srcset="assets/hero.jpg" type="image/webp"><img class="object-fit-cover w-100 h-100"
                    src="assets/hero.jpg" alt="Kampus">
            </picture>
        </section>
        <section class="container py-5" id="literature">
            <h1 class="mb-4">Loker Terbaru</h1>
            <div class="row g-4 mb-4">
                <!-- FOREACH -->
                @foreach (\App\Models\InformasiLoker::orderBy('created_at', 'DESC')->get()->take(3) as $loker)
                    <article class="literature col-md-6" data-aos="fade-right">
                        <div class="mb-2 d-flex gap-2 align-items-center">
                            {{-- <span <p class="mb-0">PT. Elabram Systems</p> --}}
                        </div><a href="/loker/{{ $loker->id }}">
                            <h5>{{ $loker->judul }}</h5>
                        </a>
                        <p class="mb-0">

                            <br>{{ $loker->created_at->diffForHumans() }}
                        </p>
                    </article>
                @endforeach

                <!-- ENDFOREACH -->

            </div><label for="search-bar"><a class="btn btn-primary" href="/loker">Cari loker lain</a></label>
        </section>
        <section class="text-bg-primary bg-primary-subtle py-5" id="fakultas">
            <div
                class="container d-flex flex-md-row flex-column align-items-md-center align-items-start justify-items-end gap-4">
                <div data-aos="fade-right">
                    <h1 class="mb-4">Beasiswa</h1><a class="btn btn-primary" href="/beasiswa">Lihat semua
                        beasiswa</a>
                </div>
                <div id="image-collage" data-aos="fade-left">
                    <!-- FOREACH MAX 3 -->
                    @foreach (\App\Models\InformasiBeasiswa::orderBy('created_at', 'DESC')->get()->take(3) as $beasiswa)
                        <img src="/storage/{{ $beasiswa->gambar }}" alt="Beasiswa" class="rounded-circle">
                    @endforeach
                    <!-- ENDFOREACH -->
                </div>
            </div>
        </section>
    </div>
@endsection
