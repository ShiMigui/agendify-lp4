@extends('base')

@section('title', 'Login')

@section('content')
    <h1>Entrar</h1>

    <form action="{{ route('login') }}" method="POST" class="auth-form">
        @csrf

        <div class="input-field">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div class="input-field">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required>
        </div>

        <label class="checkbox">
            <input type="checkbox" name="remember">
            Lembrar-me
        </label>

        <div class="options">
            <button type="submit" class="primary">Entrar</button>
            <a href="{{ route('register') }}" class="btn secondary">Criar conta</a>
        </div>
    </form>
@endsection
