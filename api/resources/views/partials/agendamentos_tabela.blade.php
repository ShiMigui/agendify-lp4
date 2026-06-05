@if ($agendamentos->isNotEmpty())
    <section class="agendamentos-grupo">
        <h2 class="agendamentos-grupo__titulo">{{ $titulo }}</h2>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Prestador</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agendamentos as $agendamento)
                        <tr>
                            <td>{{ $agendamento->servico->nome }}</td>
                            <td>{{ $agendamento->servico->prestador->name }}</td>
                            <td>{{ $agendamento->data_hora->format('d/m/Y') }}</td>
                            <td>{{ $agendamento->data_hora->format('H:i') }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('agendamentos.show', $agendamento) }}" class="btn secondary">Ver</a>
                                    @if ($agendamento->isPendente())
                                        <a href="{{ route('agendamentos.edit', $agendamento) }}" class="btn primary">Editar</a>
                                    @endif
                                    <form action="{{ route('agendamentos.destroy', $agendamento) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn danger">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endif
