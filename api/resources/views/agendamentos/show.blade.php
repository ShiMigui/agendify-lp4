@extends('base')

@section('title', 'Agendamento')

@section('content')
    <h1>Detalhes do Agendamento</h1>

    <div class="servico-resumo">
        @include('partials.servico_media', ['servico' => $agendamento->servico])
        <div class="servico-resumo__info">
            <h2>{{ $agendamento->servico->nome }}</h2>
            <p>{{ $agendamento->servico->descricao }}</p>
            <small>Prestador: {{ $agendamento->servico->prestador->name }}</small>
        </div>
    </div>

    <dl class="details">
        <dt>Data</dt>
        <dd>{{ $agendamento->data_hora->format('d/m/Y') }}</dd>

        <dt>Hora</dt>
        <dd>{{ $agendamento->data_hora->format('H:i') }}</dd>

        <dt>Status</dt>
        <dd><span class="badge badge--{{ $agendamento->status }}">{{ $agendamento->statusLabel() }}</span></dd>

        @if ($agendamento->observacoes)
            <dt>Observações</dt>
            <dd>{{ $agendamento->observacoes }}</dd>
        @endif
    </dl>

    @include('partials.agendamento_acoes_status', ['agendamento' => $agendamento])

    <div class="options">
        @if ($agendamento->isPendente())
            <a href="{{ route('agendamentos.edit', $agendamento) }}" class="btn secondary">Editar dados</a>
        @endif
        <a href="{{ route('agendamentos.index') }}" class="btn tertiary">Voltar</a>
    </div>
@endsection
