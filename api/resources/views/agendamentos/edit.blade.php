@extends('forms')

@section('title', 'Editar Agendamento')

@section('form-action', route('agendamentos.update', $agendamento))
@section('inputs')
    @method('PUT')
    @include('partials.agendamento_form', ['agendamento' => $agendamento])
@endsection
