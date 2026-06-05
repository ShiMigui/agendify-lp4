@extends('forms')

@section('title', 'Agendar ' . $servico->nome)

@section('form-action', route('agendamentos.store'))
@section('inputs')
    @include('partials.agendamento_form', ['servico' => $servico, 'agendamento' => null])
@endsection
