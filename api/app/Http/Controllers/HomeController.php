<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('home', [
            'servicosOferecidos' => $user->servicosOferecidos()->latest()->get(),
            'agendamentos' => $user->agendamentos()->with('servico.prestador')->latest()->get(),
        ]);
    }
}
