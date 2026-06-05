<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicoController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('servicos', ServicoController::class);
    Route::get('servicos/{servico}/agendar', [AgendamentoController::class, 'create'])
        ->name('agendamentos.create');
    Route::patch('agendamentos/{agendamento}/concluir', [AgendamentoController::class, 'concluir'])
        ->name('agendamentos.concluir');
    Route::patch('agendamentos/{agendamento}/cancelar', [AgendamentoController::class, 'cancelar'])
        ->name('agendamentos.cancelar');
    Route::resource('agendamentos', AgendamentoController::class)->except(['create']);
});
