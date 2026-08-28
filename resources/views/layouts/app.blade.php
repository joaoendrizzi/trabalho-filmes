<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Galeria de Filmes') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --theme-black: #0d0d0d;
            --theme-panel: #171717;
            --theme-panel-soft: #202020;
            --theme-orange: #f7971d;
            --theme-orange-dark: #df7f00;
            --theme-border: #2d2d2d;
            --theme-text: #f5f5f5;
            --theme-muted: #b9b9b9;
        }

        body {
            background: var(--theme-black);
            color: var(--theme-text);
        }

        .navbar {
            background: #050505;
            border-color: var(--theme-border);
        }

        .navbar-brand,
        .navbar-brand:hover {
            color: var(--theme-text);
        }

        .navbar-brand span {
            background: var(--theme-orange);
            color: #050505;
            border-radius: 4px;
            padding: 0.1rem 0.35rem;
            margin-left: 0.15rem;
        }

        .navbar-toggler {
            border-color: var(--theme-border);
            background: var(--theme-orange);
        }

        .nav-link,
        .nav-link:hover,
        .nav-link:focus {
            color: var(--theme-text);
        }

        .text-secondary {
            color: var(--theme-muted) !important;
        }

        .card,
        .theme-panel,
        .table,
        .form-control,
        .form-select {
            background-color: var(--theme-panel);
            color: var(--theme-text);
        }

        .card,
        .theme-panel,
        .form-control,
        .form-select,
        .table {
            border-color: var(--theme-border) !important;
        }

        .card {
            overflow: hidden;
        }

        .card-body {
            background: var(--theme-panel);
        }

        .form-control:focus,
        .form-select:focus {
            background-color: var(--theme-panel-soft);
            color: var(--theme-text);
            border-color: var(--theme-orange) !important;
            box-shadow: 0 0 0 0.2rem rgba(247, 151, 29, 0.22);
        }

        .form-label,
        .table th,
        .table td {
            color: var(--theme-text);
        }

        .table-light th,
        .table-light td,
        .table-light {
            background: #050505;
            color: var(--theme-orange);
            border-color: var(--theme-border);
        }

        .table > :not(caption) > * > * {
            background-color: transparent;
            border-color: var(--theme-border);
        }

        .btn-dark,
        .btn-dark:hover,
        .btn-dark:focus {
            background: var(--theme-orange);
            border-color: var(--theme-orange);
            color: #050505;
            font-weight: 700;
        }

        .btn-dark:hover,
        .btn-dark:focus {
            background: var(--theme-orange-dark);
            border-color: var(--theme-orange-dark);
        }

        .btn-outline-dark,
        .btn-outline-secondary {
            border-color: var(--theme-orange);
            color: var(--theme-orange);
        }

        .btn-outline-dark:hover,
        .btn-outline-dark:focus,
        .btn-outline-secondary:hover,
        .btn-outline-secondary:focus {
            background: var(--theme-orange);
            border-color: var(--theme-orange);
            color: #050505;
        }

        .btn-outline-danger {
            border-color: #ff5d45;
            color: #ff8a78;
        }

        .btn-outline-danger:hover,
        .btn-outline-danger:focus {
            background: #ff5d45;
            border-color: #ff5d45;
            color: #050505;
        }

        .badge.text-bg-secondary {
            background: var(--theme-orange) !important;
            color: #050505 !important;
        }

        .badge.text-bg-light {
            background: var(--theme-panel-soft) !important;
            color: var(--theme-text) !important;
            border-color: var(--theme-border) !important;
        }

        .alert-success {
            background: rgba(247, 151, 29, 0.16);
            border-color: var(--theme-orange);
            color: var(--theme-text);
        }

        .page-link {
            background: var(--theme-panel);
            border-color: var(--theme-border);
            color: var(--theme-orange);
        }

        .active > .page-link,
        .page-link.active,
        .page-link:hover {
            background: var(--theme-orange);
            border-color: var(--theme-orange);
            color: #050505;
        }

        a {
            color: var(--theme-orange);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg border-bottom">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('gallery.index') }}">Galeria<span>Filmes</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <a class="nav-link" href="{{ route('gallery.index') }}">Galeria</a>
                    @auth
                        <a class="nav-link" href="{{ route('movies.index') }}">Administração</a>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-dark btn-sm" type="submit">Sair</button>
                        </form>
                    @else
                        <a class="btn btn-dark btn-sm" href="{{ route('login') }}">Entrar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="container py-4 py-lg-5">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
