@extends('components.layouts.master')

@section('content')
    <div class="flex-grow-1 mt-6">
        <section id="fakultas-detail">
            <div class="heading text-white position-relative d-flex flex-column justify-content-end py-4">
                <div class="position-relative z-1 container">
                    <h1 class="mb-0">{{ $form->judul }}</h1>
                </div>
                <img class="position-absolute z-0 pe-none object-fit-cover w-100 h-100"
                    src="https://picsum.photos/id/74/1000/800" alt="Fakultas">
            </div>
            <div class="container py-5">
                <h2 class="mb-4">Hi {{ auth()->user()->name }} 👋 . Isi Kuesioner ini Dengan Jujur</h2>
                <div class="row g-4">
                    <div class="col-lg-9 col-md-8 order-md-0 order-1">
                        <div class="vstack gap-4 mb-4">
                            <form action="{{ route('responses.store', $form->id) }}" method="POST">
                                @csrf

                                @foreach ($form->questions as $question)
                                    <div class="mb-3">
                                        <label class="form-label">{{ $question->question_text }}</label>

                                        @if ($question->question_type == 'text')
                                            <input type="text" name="answers[{{ $question->id }}]" class="form-control"
                                                required>
                                        @elseif ($question->question_type == 'radio')
                                            @foreach ($question->options as $option)
                                                <div class="form-check">
                                                    <input type="radio" name="answers[{{ $question->id }}]"
                                                        value="{{ $option['option'] }}" class="form-check-input" required>
                                                    <label class="form-check-label">{{ $option['option'] }}</label>
                                                </div>
                                            @endforeach
                                        @elseif ($question->question_type == 'checkbox')
                                            @foreach ($question->options as $option)
                                                <div class="form-check">
                                                    <input type="checkbox" name="answers[{{ $question->id }}][]"
                                                        value="{{ $option['option'] }}" class="form-check-input">
                                                    <label class="form-check-label">{{ $option['option'] }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
