@extends('base')

@section('title', 'Serviços')

@section('content')
    <h1>Serviços</h1>

    @if ($servicos->isEmpty())
        <p>Sem serviços registrados.</p>
    @else
        <section class="servicos">
            @foreach ($servicos as $servico)
                <div class="servico">
                    @if ($servico->thumb)
                        <img src="{{ asset('storage/' . $servico->thumb) }}" alt="{{ $servico->nome }}">
                    @endif
                    <a href="{{ route('servicos.show', $servico) }}">
                        <h2>{{ $servico->nome }}</h2>
                        <p>{{ $servico->descricao }}</p>
                        <small>Oferecido por: {{ $servico->prestador->name }}</small>
                    </a>
                    @if ($servico->user_id === auth()->id())
                        <div class="options">
                            <a href="{{ route('servicos.edit', $servico) }}" class="btn primary">Editar</a>
                            <form action="{{ route('servicos.destroy', $servico) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="secondary">Excluir</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </section>
    @endif

    <div class="options">
        <a href="{{ route('servicos.create') }}" class="btn tertiary">Novo Serviço</a>
    </div>
@endsection
