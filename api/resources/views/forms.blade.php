@extends('base')

@section('content')
@yield('content-pre-form')
<form action="@yield('form-action')" method="POST" enctype="multipart/form-data">
    @csrf
    @yield('inputs')
    <div class="options">
        <button type="submit" class="primary">Enviar</button>
        <button type="reset" class="secondary">Cancelar</button>
    </div>
</form>
@yield('content-pos-form')
@endsection
