@extends('components.layouts.master')

@section('content')
    <div class="flex-grow-1 mt-6">
        <section id="fakultas-detail">
            <div class="heading text-white position-relative d-flex flex-column justify-content-end py-4">
                <div class="position-relative z-1 container">
                    <h1 class="mb-0">Kuesioner</h1>

                </div><img class="position-absolute z-0 pe-none object-fit-cover w-100 h-100"
                    src="https://picsum.photos/id/74/1000/800" alt="Fakultas">
            </div>
            <div class="container py-5">
                <h2 class="mb-4">Hasil Kuesioner</h2>
                <div class="row g-4">
                    <div class="col-lg-9 col-md-8 order-md-0 order-1">
                        <div class="vstack gap-4 mb-4">
                            @foreach ($responses as $response)
                                <p>
                                    @if ($response->question->question_type == 'text')
                                        {{ $response->question->question_text }}: {{ $response->answer }}
                                    @endif

                                    @if ($response->question->question_type == 'radio')
                                        {{ $response->question->question_text }}: {{ $response->answer }}
                                    @endif

                                    @if ($response->question->question_type == 'checkbox')
                                        {{ $response->question->question_text }}:
                                        @foreach (json_decode($response->answer) as $answer)
                                            {{ $answer }} ,
                                        @endforeach
                                    @endif
                                </p>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
