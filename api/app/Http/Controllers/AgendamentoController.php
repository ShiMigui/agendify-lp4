<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendamentoRequest;
use App\Models\Agendamento;
use App\Models\Servico;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Auth::user()
            ->agendamentos()
            ->with('servico.prestador')
            ->latest()
            ->get();

        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        $servicos = Servico::with('prestador')->orderBy('nome')->get();

        return view('agendamentos.create', compact('servicos'));
    }

    public function store(AgendamentoRequest $request)
    {
        Auth::user()->agendamentos()->create($request->validated());

        return redirect()
            ->route('agendamentos.index')
            ->with('success', 'Agendamento criado com sucesso.');
    }

    public function show(Agendamento $agendamento)
    {
        $this->authorizeAgendamento($agendamento);

        $agendamento->load('servico.prestador', 'usuario');

        return view('agendamentos.show', compact('agendamento'));
    }

    public function edit(Agendamento $agendamento)
    {
        $this->authorizeAgendamento($agendamento);

        $servicos = Servico::with('prestador')->orderBy('nome')->get();

        return view('agendamentos.edit', compact('agendamento', 'servicos'));
    }

    public function update(AgendamentoRequest $request, Agendamento $agendamento)
    {
        $this->authorizeAgendamento($agendamento);

        $agendamento->update($request->validated());

        return redirect()
            ->route('agendamentos.index')
            ->with('success', 'Agendamento atualizado.');
    }

    public function destroy(Agendamento $agendamento)
    {
        $this->authorizeAgendamento($agendamento);

        $agendamento->delete();

        return redirect()
            ->route('agendamentos.index')
            ->with('success', 'Agendamento removido.');
    }

    private function authorizeAgendamento(Agendamento $agendamento): void
    {
        abort_unless($agendamento->user_id === Auth::id(), 403);
    }
}
