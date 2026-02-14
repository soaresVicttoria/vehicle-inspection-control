<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proprietario extends Model
{
    /**
     * The table associated with the model
     */
    protected $table = 'proprietarios';

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'nome_completo',
        'sexo',
        'data_nascimento'
    ];

    /**
     * The attributes that should be cast
     */
    protected $casts = [
        'data_nascimento' => 'date',
    ];

    /**
     * Get the veiculos for the proprietario.
     */
    public function veiculos(): HasMany
    {
        return $this->hasMany(Veiculo::class);
    }

    /**
     * Accessor: Calcular idade a partir da data de nascimento
     */
    public function getIdadeAttribute(): int
    {
        return $this->data_nascimento->age;
    }
}
