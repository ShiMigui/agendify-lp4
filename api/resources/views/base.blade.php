<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agendify | @yield('title')</title>
        @vite('resources/scss/style.scss')
    </head>
    <body>
        <header class="header">
            <a href="{{ route('home') }}" class="logo">Agendify</a>

            @auth
                <nav class="nav">
                    <a href="{{ route('home') }}">Início</a>
                    <a href="{{ route('servicos.index') }}">Serviços</a>
                    <a href="{{ route('agendamentos.index') }}">Agendamentos</a>
                </nav>

                <div class="user-menu">
                    <span>{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="secondary">Sair</button>
                    </form>
                </div>
            @endauth
        </header>

        <main>
            @if (session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </body>
</html>
