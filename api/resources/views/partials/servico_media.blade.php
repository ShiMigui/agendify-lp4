@if ($servico->thumb)
    <img
        src="{{ asset('storage/' . $servico->thumb) }}"
        alt="{{ $servico->nome }}"
        class="servico-media"
    >
@else
    <div class="servico-placeholder" aria-hidden="true">
        <span class="servico-placeholder__icon">✂</span>
        <span class="servico-placeholder__label">Sem imagem</span>
    </div>
@endif
