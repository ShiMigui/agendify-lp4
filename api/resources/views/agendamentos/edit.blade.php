@extends('forms')

@section('title', 'Editar Agendamento')

@section('form-action', route('agendamentos.update', $agendamento))
@section('inputs')
    @method('PUT')
    @include('partials.agendamento_form', ['agendamento' => $agendamento])
@endsection

@section('content-pos-form')
    @include('partials.agendamento_acoes_status', ['agendamento' => $agendamento])
@endsection
