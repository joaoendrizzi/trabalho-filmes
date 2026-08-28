@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">Criar cadastro</h1>
                    <form method="post" action="{{ route('register.store') }}" class="vstack gap-3">
                        @csrf
                        <div>
                            <label class="form-label" for="name">Nome</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="email">E-mail</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="password">Senha</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="password_confirmation">Confirmar senha</label>
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required>
                        </div>
                        <button class="btn btn-dark" type="submit">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
