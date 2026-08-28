@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
        <div>
            <h1 class="display-6 fw-semibold mb-1">Administração</h1>
            <p class="text-secondary mb-0">Gerencie os filmes cadastrados na galeria.</p>
        </div>
        <a class="btn btn-dark align-self-start" href="{{ route('movies.create') }}">Novo filme</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="theme-panel border rounded-2 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Filme</th>
                        <th>Categoria</th>
                        <th>Ano</th>
                        <th>Criador</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movies as $movie)
                        <tr>
                            <td class="fw-semibold">{{ $movie->title }}</td>
                            <td>{{ $movie->category->name }}</td>
                            <td>{{ $movie->year }}</td>
                            <td>{{ $movie->user->name }}</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('movies.edit', $movie) }}">Editar</a>
                                    <form method="post" action="{{ route('movies.destroy', $movie) }}" onsubmit="return confirm('Excluir este filme?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger btn-sm" type="submit">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-secondary py-5" colspan="5">Nenhum filme cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $movies->links() }}
    </div>
@endsection
