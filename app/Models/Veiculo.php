<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Veiculo extends Model
{
    protected $table = 'veiculos';

    protected $fillable = [
        'proprietario_id',
        'modelo',
        'placa',
        'marca'
    ];

    public function proprietario(): BelongsTo
    {
        return $this->belongsTo(Proprietario::class);
    }

    public function revisoes(): HasMany
    {
        return $this->hasMany(Revisao::class);
    }
}
