@if ($agendamento->isPendente())
    <div class="status-actions">
        <form action="{{ route('agendamentos.concluir', $agendamento) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn primary">Concluir agendamento</button>
        </form>
        <form action="{{ route('agendamentos.cancelar', $agendamento) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn danger">Cancelar agendamento</button>
        </form>
    </div>
@endif
