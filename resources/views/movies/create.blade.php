@extends('layouts.app')

@section('content')
    <div class="theme-panel border rounded-2 p-4">
        <h1 class="h3 mb-4">Novo filme</h1>
        <form method="post" action="{{ route('movies.store') }}" enctype="multipart/form-data">
            @include('movies.form')
        </form>
    </div>
@endsection
