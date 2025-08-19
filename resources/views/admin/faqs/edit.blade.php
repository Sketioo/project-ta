@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Edit FAQ</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit FAQ</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="question" class="form-label">Pertanyaan (Bahasa Indonesia)</label>
                            <input type="text" name="question" id="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question', $faq->question) }}" required>
                            @error('question')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="answer" class="form-label">Jawaban (Bahasa Indonesia)</label>
                            <textarea name="answer" id="answer" class="form-control @error('answer') is-invalid @enderror" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                            @error('answer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <h5>Terjemahan (Opsional)</h5>

                        @php
                            $translations = $faq->translations ?? [];
                            $questionEn = isset($translations['en']['question']) ? $translations['en']['question'] : '';
                            $answerEn = isset($translations['en']['answer']) ? $translations['en']['answer'] : '';
                        @endphp

                        <div class="mb-3">
                            <label for="question_en" class="form-label">Pertanyaan (Bahasa Inggris)</label>
                            <input type="text" name="question_en" id="question_en" class="form-control @error('question_en') is-invalid @enderror" value="{{ old('question_en', $questionEn) }}">
                            @error('question_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="answer_en" class="form-label">Jawaban (Bahasa Inggris)</label>
                            <textarea name="answer_en" id="answer_en" class="form-control @error('answer_en') is-invalid @enderror" rows="5">{{ old('answer_en', $answerEn) }}</textarea>
                            @error('answer_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible" value="1" {{ old('is_visible', $faq->is_visible) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_visible">Tampilkan di Halaman Utama</label>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui FAQ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
