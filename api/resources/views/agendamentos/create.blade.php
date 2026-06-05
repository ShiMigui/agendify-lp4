@extends('forms')

@section('title', 'Novo Agendamento')

@section('form-action', route('agendamentos.store'))
@section('inputs')
    @include('partials.agendamento_form', ['agendamento' => null])
@endsection
