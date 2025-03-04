@extends('components.layouts.master')
@section('content')
    <div class="flex-grow-1 container mt-6">
        <section class="py-5" id="literature-detail">
            <h1 class="mt-2">{{ $loker->judul }}</h1>
            <p class="mb-0"><span class="fw-bold">{{ $loker->perusahaan }}</span>

                <br><br>
            <div class="bi-map"> &nbsp;&nbsp;{{ $loker->alamat }}</div>
            <div class="bi-building"> &nbsp;&nbsp;{{ $loker->judul }}</div>
            <div class="bi-clock"> &nbsp;&nbsp;{{ $loker->jenis }}</div>
            <div class="bi-coin"> &nbsp;&nbsp;Tambahkan gaji yang diharapkan ke profil untuk menambah wawasan</div>
            <br>

            </p>
            <div class="py-1 my-4 border-top border-bottom d-flex align-items-center justify-content-between">
                <div class="hstack gap-2 align-items-center"><i class="bi-upload fs-5"></i>Posted
                    {{ $loker->created_at->diffForHumans() }}</div>
                <div class="hstack gap-1">
                    <btn class="btn btn-icon link-dark"><i class="bi-share"></i></btn>
                </div>
            </div>
            <div id="literature-detail-content">
                {!! $loker->description !!}
                {{-- <a class="btn btn-danger" href="/perusahaan.html">Lamaran Cepat</a> --}}
            </div>
        </section>
    </div>
@endsection
