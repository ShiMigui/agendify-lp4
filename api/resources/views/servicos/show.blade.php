@extends('base')

@section('title', $servico->nome)

@section('content')
    <article class="servico-detalhe">
        @include('partials.servico_media', ['servico' => $servico])

        <div class="servico-detalhe__body">
            <h1>{{ $servico->nome }}</h1>
            <p class="servico-detalhe__descricao">{{ $servico->descricao }}</p>
            <p class="servico-detalhe__prestador">
                <strong>Prestador:</strong> {{ $servico->prestador->name }}
            </p>
        </div>
    </article>

    <div class="options">
        @if ($servico->user_id !== auth()->id())
            <a href="{{ route('agendamentos.create', $servico) }}" class="btn primary">Agendar</a>
        @else
            <span class="aviso">Este é o seu serviço — agendamento não disponível.</span>
        @endif

        @if ($servico->user_id === auth()->id())
            <a href="{{ route('servicos.edit', $servico) }}" class="btn secondary">Editar</a>
        @endif

        <a href="{{ route('servicos.index') }}" class="btn tertiary">Voltar</a>
    </div>
@endsection
