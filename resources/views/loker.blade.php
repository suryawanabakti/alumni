@extends('components.layouts.master')
@section('content')
    <div class="flex-grow-1 container mt-6">
        <section class="py-5" id="search">
            <form action="{{ url('/loker') }}" method="GET">
                <div class="d-flex justify-content-sm-start justify-content-between align-items-sm-end align-items-start flex-column flex-sm-row gap-3">
                    <div class="flex-grow-1">
                        <h1>Lowongan Kerja</h1>
                    </div>
            
                    <!-- Sortir -->
                    <div id="sort-wrapper">
                        <div class="form-floating">
                            <select name="sortir" class="form-select" id="sort" aria-labelledby="sort-label">
                                <option value="asc" {{ request('sortir') == 'asc' ? 'selected' : '' }}>Terbaru</option>
                                <option value="desc" {{ request('sortir') == 'desc' ? 'selected' : '' }}>Terlama</option>
                            </select>
                            <label id="sort-label" for="sort">Urutan</label>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
            
                <div class="row g-4">
                    <div class="col-lg-3 col-md-4" id="filter">
                        <div class="accordion-item accordion border-0 rounded-0">
                            <h6 class="mb-0 accordion-button collapsed border rounded" data-bs-toggle="collapse"
                                data-bs-target="#filter-content" aria-expanded="false" aria-controls="filter-content">
                                Filter
                            </h6>
                        </div>
                        <div class="accordion-collapse collapse show" id="filter-content">
                            <div>
                                <p class="mb-2">Jenis Pekerjaan</p>
                                <div class="filter-list">
                                    @php
                                        $selectedFilters = request()->has('filter') ? request('filter') : [];
                                    @endphp
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" name="filter[]" id="full-time" type="checkbox" 
                                            value="Full Time" {{ in_array("Full Time", $selectedFilters) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="full-time">Full Time</label>
                                    </div>
            
                                    <div class="form-check">
                                        <input class="form-check-input" name="filter[]" id="part-time" type="checkbox" 
                                            value="Paru Waktu" {{ in_array("Paru Waktu", $selectedFilters) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="part-time">Paru Waktu</label>
                                    </div>
            
                                    <div class="form-check">
                                        <input class="form-check-input" name="filter[]" id="kontrak" type="checkbox" 
                                            value="Kontrak" {{ in_array("Kontrak", $selectedFilters) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kontrak">Kontrak</label>
                                    </div>
            
                                    <div class="form-check">
                                        <input class="form-check-input" name="filter[]" id="kasual" type="checkbox" 
                                            value="Kasual" {{ in_array("Kasual", $selectedFilters) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kasual">Kasual/liburan</label>
                                    </div>
                                </div>
                            </div>
            
                            <button class="btn btn-primary w-100 mt-3" type="submit">Filter</button>
                        </div>
                    </div>
            
                    <!-- List Lowongan -->
                    <div class="col-lg-9 col-md-8">
                        <div class="vstack gap-4">
                            @foreach ($loker as $l)
                                <article class="literature"
                                    style="box-shadow: 2px 2px 2px rgba(0, 38, 88, 0.8);padding: 10px;border: 1px dashed rgb(115, 158, 236);">
                                    <div class="mb-2 d-flex gap-2 align-items-center">
                                        <p class="mb-0">{{ $l->perusahaan }}</p>
                                    </div>
                                    <a href="/loker/{{ $l->id }}">
                                        <h5>{{ $l->judul }}</h5>
                                    </a>
                                    <p class="mb-0">
                                        <span class="fw-bold">{{ $l->alamat }}</span>
                                        <br> {{ $l->created_at->diffForHumans() }}
                                    </p>
                                </article>
                            @endforeach
                        </div>
                        {{ $loker->links() }}
                    </div>
                </div>
            </form>
            
        </section>
    </div>
@endsection
