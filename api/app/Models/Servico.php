<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servico extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'thumb',
    ];

    public function prestador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agendamentos(): HasMany
    {
        return $this->hasMany(Agendamento::class);
    }
}
