@extends('components.layouts.master')
@section('content')
    <div class="flex-grow-1 container mt-6">
        <section class="py-5" id="search">
            <div
                class="d-flex justify-content-sm-start justify-content-between align-items-sm-end align-items-start flex-column flex-sm-row gap-3">
                <div class="flex-grow-1">
                    <h1>Lowongan Kerja</h1>
                    <p class="mb-0">Ditemukan 213 hasil dari
                        <strong>IT Support</strong>
                    </p>
                </div>
                <div id="sort-wrapper">
                    <div class="form-floating"><select class="form-select" id="sort" aria-labelledby="sort-label">
                            <option value="date,asc">Terbaru</option>
                            <option value="">Terlama</option>


                        </select><label id="sort-label" for="sort">Urutan</label></div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row g-4">
                <div class="col-lg-3 col-md-4" id="filter">
                    <div class="accordion-item accordion border-0 rounded-0">
                        <h6 class="mb-0 accordion-button collapsed border rounded" data-bs-toggle="collapse"
                            data-bs-target="#filter-content" aria-expanded="false" aria-controls="filter-content">Filter
                        </h6>
                    </div>
                    <form class="accordion-collapse collapse" id="filter-content">
                        <div>
                            <p class="mb-2">Semua jenis pekerjaan</p>
                            <div class="filter-list">
                                <div class="form-check"><input class="form-check-input" id="disertasi-0" type="checkbox"
                                        value=""><label class="form-check-label" for="disertasi-0">Full time</label>
                                </div>
                                <div class="form-check"><input class="form-check-input" id="tesis-1" type="checkbox"
                                        value=""><label class="form-check-label" for="tesis-1">Paru waktu</label>
                                </div>
                                <div class="form-check"><input class="form-check-input" id="tugas-akhir-2" type="checkbox"
                                        value=""><label class="form-check-label" for="tugas-akhir-2">Kontrak<span
                                            class="text-body-tertiary"></span></label></div>
                                <div class="form-check"><input class="form-check-input" id="tugas-akhir-2" type="checkbox"
                                        value=""><label class="form-check-label"
                                        for="tugas-akhir-2">Kasual/liburan<span class="text-body-tertiary"></span></label>
                                </div>
                            </div><button
                                class="btn btn-link link-dark p-0 mt-2 d-flex align-items-center gap-2 d-none text-start"
                                type="button"><span>Lihat lebih banyak</span><i class="bi-chevron-down"></i></button>
                        </div>

                        <div>

                            <button
                                class="btn btn-link link-dark p-0 mt-2 d-flex align-items-center gap-2 d-none text-start"
                                type="button"><span>Lihat lebih banyak</span><i class="bi-chevron-down"></i></button>
                        </div><button class="btn btn-primary w-100" type="submit">Filter</button>
                    </form>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="vstack gap-4">
                        @foreach ($loker as $l)
                            <article class="literature"
                                style="box-shadow: 2px 2px 2px rgba(0, 38, 88, 0.8);padding: 10px;border: 1px dashed rgb(115, 158, 236);">
                                <div class="mb-2 d-flex gap-2 align-items-center">
                                    <p class="mb-0">{{ $l->perusahaan }}</p>
                                </div><a href="/loker/{{ $l->id }}">
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
        </section>
    </div>
@endsection
