@extends('components.layouts.master')

@section('content')
    <div class="flex-grow-1 container mt-6">
        <div class="text-center"><img class="w-50 h-50" src="/storage/{{ $beasiswa->gambar }}" alt=""></div>

        <section class="py-5" id="literature-detail">

            <h1 class="mt-2">{{ $beasiswa->judul }}</h1>
            <p class="mb-0">

                <br>

            </p>
            <div class="py-1 my-4 border-top border-bottom d-flex align-items-center justify-content-between">
                <div class="hstack gap-2 align-items-center"><i class="bi-upload fs-5"></i>Posted 3 hari yang lalu</div>
                <div class="hstack gap-1">
                    <btn class="btn btn-icon link-dark"><i class="bi-share"></i></btn>
                </div>
            </div>
            <div id="literature-detail-content">
                {!! $beasiswa->description !!}
                {{-- <a class="btn btn-danger" href="/perusahaan.html">Daftar</a> --}}
            </div>
        </section>
    </div>
@endsection
