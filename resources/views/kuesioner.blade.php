@extends('components.layouts.master')

@section('content')
    <div class="flex-grow-1 mt-6">
        <section id="fakultas-detail">
            <div class="heading text-white position-relative d-flex flex-column justify-content-end py-4">
                <div class="position-relative z-1 container">
                    <h1 class="mb-0">Pilih Kuesioner</h1>

                </div><img class="position-absolute z-0 pe-none object-fit-cover w-100 h-100"
                    src="https://picsum.photos/id/74/1000/800" alt="Fakultas">
            </div>
            <div class="container py-5">
                @foreach ($form as $data)
                    <a href="/kuesioner/{{ $data->id }}" class="text-primary">{{ $data->judul }}</a> <br>
                @endforeach
            </div>
        </section>
    </div>
@endsection
