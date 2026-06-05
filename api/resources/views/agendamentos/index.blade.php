@extends('base')

@section('title', 'Agendamentos')

@section('content')
    <div class="page-header">
        <h1>Meus Agendamentos</h1>
        <a href="{{ route('servicos.index') }}" class="btn primary">Ver serviços</a>
    </div>

    @if ($pendentes->isEmpty() && $concluidos->isEmpty() && $cancelados->isEmpty())
        <div class="empty-state">
            <p>Nenhum agendamento registrado.</p>
            <a href="{{ route('servicos.index') }}" class="btn secondary">Escolher um serviço</a>
        </div>
    @else
        @include('partials.agendamentos_tabela', ['titulo' => 'Pendentes', 'agendamentos' => $pendentes])
        @include('partials.agendamentos_tabela', ['titulo' => 'Concluídos', 'agendamentos' => $concluidos])
        @include('partials.agendamentos_tabela', ['titulo' => 'Cancelados', 'agendamentos' => $cancelados])
    @endif
@endsection
