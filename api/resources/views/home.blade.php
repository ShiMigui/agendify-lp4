@extends('base')

@section('title', 'Início')

@section('content')
    <h1>Olá, {{ auth()->user()->name }}</h1>

    <section class="dashboard">
        <div class="card">
            <h2>Meus agendamentos</h2>
            @if ($agendamentos->isEmpty())
                <p>Nenhum agendamento ainda.</p>
                <a href="{{ route('agendamentos.create') }}" class="btn primary">Agendar serviço</a>
            @else
                <ul class="list">
                    @foreach ($agendamentos as $agendamento)
                        <li>
                            <strong>{{ $agendamento->servico->nome }}</strong>
                            — {{ $agendamento->data_hora->format('d/m/Y H:i') }}
                            <span class="badge">{{ $agendamento->status }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('agendamentos.index') }}">Ver todos</a>
            @endif
        </div>

        <div class="card">
            <h2>Serviços que ofereço</h2>
            @if ($servicosOferecidos->isEmpty())
                <p>Você ainda não cadastrou serviços.</p>
                <a href="{{ route('servicos.create') }}" class="btn primary">Cadastrar serviço</a>
            @else
                <ul class="list">
                    @foreach ($servicosOferecidos as $servico)
                        <li>
                            <a href="{{ route('servicos.show', $servico) }}">{{ $servico->nome }}</a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('servicos.index') }}">Ver todos</a>
            @endif
        </div>
    </section>
@endsection
