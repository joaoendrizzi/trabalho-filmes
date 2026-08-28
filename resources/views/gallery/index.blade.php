@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
        <div>
            <h1 class="display-6 fw-semibold mb-1">Galeria</h1>
            <p class="text-secondary mb-0">Explore os filmes cadastrados por ano e categoria.</p>
        </div>
        @auth
            <a class="btn btn-dark align-self-start" href="{{ route('movies.create') }}">Novo filme</a>
        @endauth
    </div>

    <form method="get" class="row g-3 theme-panel border rounded-2 p-3 mb-4">
        <div class="col-md-4">
            <label class="form-label" for="year">Ano</label>
            <select class="form-select" id="year" name="year">
                <option value="">Todos</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" @selected(request('year') == $year)>{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5">
            <label class="form-label" for="category_id">Categoria</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Todas</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end gap-2">
            <button class="btn btn-dark flex-fill" type="submit">Filtrar</button>
            <a class="btn btn-outline-secondary" href="{{ route('gallery.index') }}">Limpar</a>
        </div>
    </form>

    <div class="row g-4">
        @forelse($movies as $movie)
            <div class="col-sm-6 col-lg-4">
                <div class="card h-100 border shadow-sm">
                    @if($movie->cover_image)
                        <img class="card-img-top object-fit-cover" src="{{ asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}" style="height: 280px">
                    @else
                        <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 280px">
                            <span class="fs-5 fw-semibold">{{ $movie->title }}</span>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between gap-2 mb-2">
                            <span class="badge text-bg-secondary">{{ $movie->category->name }}</span>
                            <span class="text-secondary small">{{ $movie->year }}</span>
                        </div>
                        <h2 class="h5">{{ $movie->title }}</h2>
                        <p class="text-secondary flex-grow-1">{{ Str::limit($movie->synopsis, 120) }}</p>
                        <a class="btn btn-outline-dark mt-2" href="{{ route('gallery.show', $movie) }}">Ver detalhes</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="theme-panel border rounded-2 p-5 text-center text-secondary">Nenhum filme encontrado.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $movies->links() }}
    </div>
@endsection
