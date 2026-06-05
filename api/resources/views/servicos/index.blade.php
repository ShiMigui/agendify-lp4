@extends('base')

@section('title', 'Serviços')

@section('content')
    <div class="page-header">
        <h1>Serviços</h1>
        <a href="{{ route('servicos.create') }}" class="btn primary">Novo Serviço</a>
    </div>

    @if ($servicos->isEmpty())
        <div class="empty-state">
            <p>Nenhum serviço cadastrado ainda.</p>
        </div>
    @else
        <section class="servicos">
            @foreach ($servicos as $servico)
                <article class="servico-card">
                    <a href="{{ route('servicos.show', $servico) }}" class="servico-card__link">
                        @include('partials.servico_media', ['servico' => $servico])
                        <div class="servico-card__body">
                            <h2>{{ $servico->nome }}</h2>
                            <p>{{ Str::limit($servico->descricao, 90) }}</p>
                            <small>{{ $servico->prestador->name }}</small>
                        </div>
                    </a>

                    @if ($servico->user_id === auth()->id())
                        <div class="servico-card__actions">
                            <a href="{{ route('servicos.edit', $servico) }}" class="btn secondary">Editar</a>
                            <form action="{{ route('servicos.destroy', $servico) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn danger">Excluir</button>
                            </form>
                        </div>
                    @elseif ($servico->user_id !== auth()->id())
                        <div class="servico-card__actions">
                            <a href="{{ route('agendamentos.create', $servico) }}" class="btn primary">Agendar</a>
                        </div>
                    @endif
                </article>
            @endforeach
        </section>
    @endif
@endsection
