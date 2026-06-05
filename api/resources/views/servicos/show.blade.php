@extends('base')

@section('title', $servico->nome)

@section('content')
    <h1>{{ $servico->nome }}</h1>

    @if ($servico->thumb)
        <img src="{{ asset('storage/' . $servico->thumb) }}" alt="{{ $servico->nome }}" class="thumb">
    @endif

    <p>{{ $servico->descricao }}</p>
    <p><strong>Prestador:</strong> {{ $servico->prestador->name }}</p>

    <div class="options">
        <a href="{{ route('agendamentos.create', ['servico_id' => $servico->id]) }}" class="btn primary">Agendar</a>
        @if ($servico->user_id === auth()->id())
            <a href="{{ route('servicos.edit', $servico) }}" class="btn secondary">Editar</a>
        @endif
        <a href="{{ route('servicos.index') }}" class="btn tertiary">Voltar</a>
    </div>
@endsection
