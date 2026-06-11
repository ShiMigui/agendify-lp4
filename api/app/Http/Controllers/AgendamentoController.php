<?php

declare(strict_types=1);

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
            ->orderBy('data_hora')
            ->get();

        return view('agendamentos.index', [
            'pendentes' => $agendamentos->where('status', 'pendente')->values(),
            'concluidos' => $agendamentos->where('status', 'confirmado')->values(),
            'cancelados' => $agendamentos->where('status', 'cancelado')->values(),
        ]);
    }

    public function create(Servico $servico)
    {
        $this->authorizeServicoAgendavel($servico);

        $servico->load('prestador');

        return view('agendamentos.create', compact('servico'));
    }

    public function store(AgendamentoRequest $request)
    {
        $data = $request->agendamentoData();
        $data['status'] = 'pendente';

        Auth::user()->agendamentos()->create($data);

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

        $agendamento->load('servico.prestador');

        return view('agendamentos.edit', compact('agendamento'));
    }

    public function update(AgendamentoRequest $request, Agendamento $agendamento)
    {
        $this->authorizeAgendamento($agendamento);

        $agendamento->update($request->agendamentoData());

        return redirect()
            ->route('agendamentos.index')
            ->with('success', 'Agendamento atualizado.');
    }

    public function concluir(Agendamento $agendamento)
    {
        $this->authorizeAgendamento($agendamento);
        $this->authorizeStatusPendente($agendamento);

        $agendamento->update(['status' => 'confirmado']);

        return redirect()
            ->route('agendamentos.index')
            ->with('success', 'Agendamento concluído.');
    }

    public function cancelar(Agendamento $agendamento)
    {
        $this->authorizeAgendamento($agendamento);
        $this->authorizeStatusPendente($agendamento);

        $agendamento->update(['status' => 'cancelado']);

        return redirect()
            ->route('agendamentos.index')
            ->with('success', 'Agendamento cancelado.');
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

    private function authorizeServicoAgendavel(Servico $servico): void
    {
        abort_if(
            $servico->user_id === Auth::id(),
            403,
            'Você não pode agendar seu próprio serviço.'
        );
    }

    private function authorizeStatusPendente(Agendamento $agendamento): void
    {
        abort_unless($agendamento->isPendente(), 403, 'Apenas agendamentos pendentes podem ser alterados.');
    }
}
