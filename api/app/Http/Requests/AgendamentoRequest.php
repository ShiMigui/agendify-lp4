<?php

namespace App\Http\Requests;

use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

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
            'data' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i'],
            'observacoes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $servico = Servico::find($this->input('servico_id'));

            if ($servico && $servico->user_id === Auth::id()) {
                $validator->errors()->add(
                    'servico_id',
                    'Você não pode agendar seu próprio serviço.'
                );
            }

            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            if (! $this->filled(['data', 'hora'])) {
                return;
            }

            $dataHora = Carbon::createFromFormat(
                'Y-m-d H:i',
                $this->input('data') . ' ' . $this->input('hora')
            );

            if ($this->isMethod('post') && $dataHora->lte(now())) {
                $validator->errors()->add(
                    'hora',
                    'A data e hora devem ser posteriores ao momento atual.'
                );
            }
        });
    }

    public function agendamentoData(): array
    {
        $dataHora = Carbon::createFromFormat(
            'Y-m-d H:i',
            $this->validated('data') . ' ' . $this->validated('hora')
        );

        return [
            'servico_id' => $this->validated('servico_id'),
            'data_hora' => $dataHora,
            'observacoes' => $this->validated('observacoes'),
        ];
    }

    public function attributes(): array
    {
        return [
            'data' => 'data',
            'hora' => 'hora',
        ];
    }
}
