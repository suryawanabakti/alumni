@extends('components.layouts.master')
@section('content')
    <div class="flex-grow-1 container mt-6">
        <section class="py-5" id="fakultas-list">
            <h1 class="mb-4">Beasiswa</h1>
            <div class="row g-4">
                @foreach ($beasiswa as $data)
                    <a class="col-md-4" href="/beasiswa/{{ $data->id }}"><img src="storage/{{ $data->gambar }}">
                        <h6>Beasiswa Teladan</h6>
                    </a>
                @endforeach

            </div>
        </section>
    </div>
@endsection
