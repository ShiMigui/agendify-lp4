@extends('base')

@section('title', 'Agendamento')

@section('content')
    <h1>Detalhes do Agendamento</h1>

    <dl class="details">
        <dt>Serviço</dt>
        <dd>{{ $agendamento->servico->nome }}</dd>

        <dt>Prestador</dt>
        <dd>{{ $agendamento->servico->prestador->name }}</dd>

        <dt>Data e hora</dt>
        <dd>{{ $agendamento->data_hora->format('d/m/Y H:i') }}</dd>

        <dt>Status</dt>
        <dd><span class="badge">{{ $agendamento->status }}</span></dd>

        @if ($agendamento->observacoes)
            <dt>Observações</dt>
            <dd>{{ $agendamento->observacoes }}</dd>
        @endif
    </dl>

    <div class="options">
        <a href="{{ route('agendamentos.edit', $agendamento) }}" class="btn primary">Editar</a>
        <a href="{{ route('agendamentos.index') }}" class="btn tertiary">Voltar</a>
    </div>
@endsection
