<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoRequest;
use App\Models\Servico;
use Illuminate\Support\Facades\Auth;

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::with('prestador')->latest()->get();

        return view('servicos.index', compact('servicos'));
    }

    public function create()
    {
        return view('servicos.create');
    }

    public function store(ServicoRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('thumb')) {
            $data['thumb'] = $request
                ->file('thumb')
                ->store('servicos', 'public');
        }

        Servico::create($data);

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço cadastrado com sucesso.');
    }

    public function show(Servico $servico)
    {
        $servico->load('prestador', 'agendamentos.usuario');

        return view('servicos.show', compact('servico'));
    }

    public function edit(Servico $servico)
    {
        $this->authorizeServico($servico);

        return view('servicos.edit', compact('servico'));
    }

    public function update(ServicoRequest $request, Servico $servico)
    {
        $this->authorizeServico($servico);

        $data = $request->validated();

        if ($request->hasFile('thumb')) {
            $data['thumb'] = $request
                ->file('thumb')
                ->store('servicos', 'public');
        }

        $servico->update($data);

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço atualizado.');
    }

    public function destroy(Servico $servico)
    {
        $this->authorizeServico($servico);

        $servico->delete();

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço removido.');
    }

    private function authorizeServico(Servico $servico): void
    {
        abort_unless($servico->user_id === Auth::id(), 403);
    }
}
