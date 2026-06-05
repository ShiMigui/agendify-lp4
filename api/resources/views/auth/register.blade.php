@extends('base')

@section('title', 'Cadastro')

@section('content')
    <form action="{{ route('register') }}" method="POST" class="auth-form">
        <h1>Criar conta</h1>
        @csrf

        <div class="input-field">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="input-field">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div class="input-field">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="input-field">
            <label for="password_confirmation">Confirmar senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div class="options">
            <button type="submit" class="btn primary">Cadastrar</button>
            <a href="{{ route('login') }}" class="btn secondary">Já tenho conta</a>
        </div>
    </form>
@endsection
