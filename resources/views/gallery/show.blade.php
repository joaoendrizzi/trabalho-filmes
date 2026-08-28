@extends('layouts.app')

@section('content')
    <a class="btn btn-outline-secondary mb-4" href="{{ route('gallery.index') }}">Voltar</a>

    <div class="row g-4 align-items-start">
        <div class="col-lg-5">
            @if($movie->cover_image)
                <img class="img-fluid rounded-2 shadow-sm w-100" src="{{ asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}">
            @else
                <div class="bg-dark text-white rounded-2 d-flex align-items-center justify-content-center shadow-sm" style="min-height: 420px">
                    <span class="fs-3 fw-semibold">{{ $movie->title }}</span>
                </div>
            @endif
        </div>
        <div class="col-lg-7">
            <div class="theme-panel border rounded-2 p-4">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge text-bg-secondary">{{ $movie->category->name }}</span>
                    <span class="badge text-bg-light border">{{ $movie->year }}</span>
                    <span class="badge text-bg-light border">{{ $movie->user->name }}</span>
                </div>
                <h1 class="display-6 fw-semibold">{{ $movie->title }}</h1>
                <p class="lead text-secondary">{{ $movie->synopsis }}</p>

                @if($embedUrl)
                    <div class="ratio ratio-16x9 mt-4">
                        <iframe src="{{ $embedUrl }}" title="Trailer de {{ $movie->title }}" allowfullscreen></iframe>
                    </div>
                @elseif($movie->trailer_url)
                    <a class="btn btn-dark mt-3" href="{{ $movie->trailer_url }}" target="_blank" rel="noopener">Abrir trailer</a>
                @endif
            </div>
        </div>
    </div>
@endsection
