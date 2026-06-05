@extends('forms')

@section('title', 'Editar Serviço | ' . $servico->nome)

@section('form-action', route('servicos.update', $servico))
@section('inputs')
    @method('PUT')
    @include('partials.servico_form', ['servico' => $servico])
@endsection
