@extends('layouts.app')

@section('content')
    <div class="theme-panel border rounded-2 p-4">
        <h1 class="h3 mb-4">Editar filme</h1>
        <form method="post" action="{{ route('movies.update', $movie) }}" enctype="multipart/form-data">
            @method('put')
            @include('movies.form')
        </form>
    </div>
@endsection
