<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Revisao extends Model
{
    protected $table = 'revisoes';

    protected $fillable = [
        'veiculo_id',
        'data_revisao',
        'duracao_servico'
    ];

    protected $casts = [
        'data_revisao' => 'date',
    ];

    public function veiculo(): BelongsTo
    {
        return $this->belongsTo(Veiculo::class);
    }
}
