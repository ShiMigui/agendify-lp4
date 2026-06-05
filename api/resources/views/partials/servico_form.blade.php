<div class="input-field">
    <label for="inpThumb">Imagem (opcional)</label>
    <input type="file" name="thumb" id="inpThumb" accept="image/*">
</div>
@error('thumb')
    <small class="field-error">{{ $message }}</small>
@enderror

<div class="input-field">
    <label for="inpNome">Nome</label>
    <input type="text" name="nome" value="{{ old('nome', $servico?->nome) }}" id="inpNome" required>
</div>
@error('nome')
    <small class="field-error">{{ $message }}</small>
@enderror

<div class="input-field">
    <label for="inpDescricao">Descrição</label>
    <textarea id="inpDescricao" name="descricao" class="textarea-descricao" rows="10" required>{{ old('descricao', $servico?->descricao) }}</textarea>
</div>
@error('descricao')
    <small class="field-error">{{ $message }}</small>
@enderror
