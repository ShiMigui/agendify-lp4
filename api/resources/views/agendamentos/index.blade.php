@extends('base')

@section('title', 'Agendamentos')

@section('content')
    <h1>Meus Agendamentos</h1>

    @if ($agendamentos->isEmpty())
        <p>Nenhum agendamento registrado.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Serviço</th>
                    <th>Prestador</th>
                    <th>Data/Hora</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agendamentos as $agendamento)
                    <tr>
                        <td>{{ $agendamento->servico->nome }}</td>
                        <td>{{ $agendamento->servico->prestador->name }}</td>
                        <td>{{ $agendamento->data_hora->format('d/m/Y H:i') }}</td>
                        <td><span class="badge">{{ $agendamento->status }}</span></td>
                        <td class="options">
                            <a href="{{ route('agendamentos.show', $agendamento) }}" class="btn secondary">Ver</a>
                            <a href="{{ route('agendamentos.edit', $agendamento) }}" class="btn primary">Editar</a>
                            <form action="{{ route('agendamentos.destroy', $agendamento) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="secondary">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="options">
        <a href="{{ route('agendamentos.create') }}" class="btn tertiary">Novo Agendamento</a>
    </div>
@endsection
