@extends('components.layouts.master')
@section('content')
    <div class="flex-grow-1 container mt-6">
        <section class="py-5" id="fakultas-list">
            <h1 class="mb-4">Mahasiswa Prestasi</h1>
            <div class="row g-4">
                @foreach ($prestasi as $data)
                    <a class="col-md-4" href="#">
                        <img src="storage/{{ $data->avatar }}">
                        <h6>{{$data->username}} - {{$data->name}}</h6>
                       <p>IPK : {{$data->ipk}} <br/>
                        Prodi : {{$data->prodi}} <br/>
                        No. HP : {{$data->no_telp}} <br/>
                        Angkatan : {{$data->angkatan}} <br/>
                       </p>
                    </a>
                @endforeach

            </div>
        </section>
    </div>
@endsection
