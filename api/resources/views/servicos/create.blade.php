@extends('forms')

@section('title', 'Criar Serviço')

@section('form-action', route('servicos.store'))
@section('inputs')
    @include('partials.servico_form', ['servico' => null])
@endsection
