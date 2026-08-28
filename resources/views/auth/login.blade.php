@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">Entrar</h1>
                    <form method="post" action="{{ route('login.authenticate') }}" class="vstack gap-3">
                        @csrf
                        <div>
                            <label class="form-label" for="email">E-mail</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
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
                        <div class="form-check">
                            <input class="form-check-input" id="remember" name="remember" type="checkbox" value="1">
                            <label class="form-check-label" for="remember">Manter conectado</label>
                        </div>
                        <button class="btn btn-dark" type="submit">Entrar</button>
                    </form>
                    <p class="mb-0 mt-4 text-secondary">Não tem conta? <a href="{{ route('register') }}">Criar cadastro</a></p>
                    <p class="mb-0 mt-2 text-secondary small">Teste: test@example.com / password</p>
                </div>
            </div>
        </div>
    </div>
@endsection
