<div class="input-field">
    <label for="servico_id">Serviço</label>
    <select name="servico_id" id="servico_id" required>
        <option value="">Selecione...</option>
        @foreach ($servicos as $servico)
            <option value="{{ $servico->id }}"
                @selected(old('servico_id', $agendamento?->servico_id ?? request('servico_id')) == $servico->id)>
                {{ $servico->nome }} — {{ $servico->prestador->name }}
            </option>
        @endforeach
    </select>
</div>
@error('servico_id')
    <small>{{ $message }}</small>
@enderror

<div class="input-field">
    <label for="data_hora">Data e hora</label>
    <input type="datetime-local" name="data_hora" id="data_hora"
        value="{{ old('data_hora', $agendamento?->data_hora?->format('Y-m-d\TH:i')) }}" required>
</div>
@error('data_hora')
    <small>{{ $message }}</small>
@enderror

<div class="input-field">
    <label for="status">Status</label>
    <select name="status" id="status">
        @foreach (['pendente', 'confirmado', 'cancelado'] as $status)
            <option value="{{ $status }}"
                @selected(old('status', $agendamento?->status ?? 'pendente') === $status)>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>
@error('status')
    <small>{{ $message }}</small>
@enderror

<div class="input-field">
    <label for="observacoes">Observações</label>
    <textarea name="observacoes" id="observacoes">{{ old('observacoes', $agendamento?->observacoes) }}</textarea>
</div>
@error('observacoes')
    <small>{{ $message }}</small>
@enderror
