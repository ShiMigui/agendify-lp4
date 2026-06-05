<?php

namespace Database\Seeders;

use App\Models\Agendamento;
use App\Models\Servico;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $prestador = User::create([
            'name' => 'João Prestador',
            'email' => 'joao@agendify.com',
            'password' => 'password',
        ]);

        $cliente = User::create([
            'name' => 'Maria Cliente',
            'email' => 'maria@agendify.com',
            'password' => 'password',
        ]);

        $corte = Servico::create([
            'user_id' => $prestador->id,
            'nome' => 'Corte de cabelo',
            'descricao' => 'Corte masculino tradicional',
        ]);

        $manicure = Servico::create([
            'user_id' => $prestador->id,
            'nome' => 'Manicure',
            'descricao' => 'Cuidados com unhas',
        ]);

        Agendamento::create([
            'user_id' => $cliente->id,
            'servico_id' => $corte->id,
            'data_hora' => now()->addDays(2)->setTime(10, 0),
            'status' => 'pendente',
            'observacoes' => 'Primeiro agendamento de exemplo',
        ]);

        Agendamento::create([
            'user_id' => $cliente->id,
            'servico_id' => $manicure->id,
            'data_hora' => now()->addDays(5)->setTime(14, 30),
            'status' => 'confirmado',
        ]);
    }
}
