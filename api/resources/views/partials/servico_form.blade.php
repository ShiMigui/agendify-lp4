<div class="input-field">
    <label for="inpThumb">
        Thumbnail
    </label>

    <input type="file" name="thumb" id="inpThumb" accept="image/*" >
</div>
@error('thumb')
    <small>{{ $message }}</small>
@enderror
<div class="input-field">
    <label for="inpNome">Nome</label>
    <input type="text" name="nome" value="{{old('nome', $servico?->nome)}}" id="inpNome">
</div>
@error('nome')
    <small>{{ $message }}</small>
@enderror
<div class="input-field">
    <label for="inpDescricao">Descricao</label>
    <textarea id="inpDescricao" name="descricao">{{old('descricao', $servico?->descricao??' ')}}</textarea>
</div>
@error('descricao')
    <small>{{ $message }}</small>
@enderror
