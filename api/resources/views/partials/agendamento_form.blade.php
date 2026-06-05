@php
    $servicoAtual = $servico ?? $agendamento?->servico;
    $dataValor = old('data', $agendamento?->data_hora?->format('Y-m-d') ?? now()->format('Y-m-d'));
    $horaValor = old('hora', $agendamento?->data_hora?->format('H:i'));
@endphp

<input type="hidden" name="servico_id" value="{{ $servicoAtual->id }}">

<div class="servico-resumo">
    @include('partials.servico_media', ['servico' => $servicoAtual])
    <div class="servico-resumo__info">
        <h2>{{ $servicoAtual->nome }}</h2>
        <p>{{ $servicoAtual->descricao }}</p>
        <small>Prestador: {{ $servicoAtual->prestador->name }}</small>
    </div>
</div>

<div class="input-row">
    <div class="input-field">
        <label for="data">Data</label>
        <input type="date" name="data" id="data" value="{{ $dataValor }}" required>
    </div>
    @error('data')
        <small class="field-error">{{ $message }}</small>
    @enderror

    <div class="input-field">
        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora" value="{{ $horaValor }}" required>
    </div>
    @error('hora')
        <small class="field-error">{{ $message }}</small>
    @enderror
</div>

<div class="input-field">
    <label for="observacoes">Observações</label>
    <textarea name="observacoes" id="observacoes" rows="5">{{ old('observacoes', $agendamento?->observacoes) }}</textarea>
</div>
@error('observacoes')
    <small class="field-error">{{ $message }}</small>
@enderror

@error('servico_id')
    <small class="field-error">{{ $message }}</small>
@enderror
