<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'servico_id' => ['required', 'exists:servicos,id'],
            'data_hora' => ['required', 'date', 'after:now'],
            'status' => ['nullable', 'in:pendente,confirmado,cancelado'],
            'observacoes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'servico_id.required' => 'Selecione um serviço.',
            'servico_id.exists' => 'Serviço inválido.',
            'data_hora.required' => 'Informe a data e hora.',
            'data_hora.after' => 'A data deve ser futura.',
        ];
    }
}
