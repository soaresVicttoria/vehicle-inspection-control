<?php

namespace Database\Seeders;

use App\Models\Proprietario;
use Illuminate\Database\Seeder;

class ProprietarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proprietarios = [
            [
                'nome_completo' => 'João Silva Santos',
                'sexo' => 'M',
                'data_nascimento' => '1985-03-15',
            ],
            [
                'nome_completo' => 'Maria Oliveira Costa',
                'sexo' => 'F',
                'data_nascimento' => '1990-07-22',
            ],
            [
                'nome_completo' => 'Carlos Eduardo Souza',
                'sexo' => 'M',
                'data_nascimento' => '1978-11-30',
            ],
            [
                'nome_completo' => 'Ana Paula Ferreira',
                'sexo' => 'F',
                'data_nascimento' => '1995-05-18',
            ],
            [
                'nome_completo' => 'Pedro Henrique Lima',
                'sexo' => 'M',
                'data_nascimento' => '1988-09-10',
            ],
            [
                'nome_completo' => 'Juliana Martins Rocha',
                'sexo' => 'F',
                'data_nascimento' => '1992-12-25',
            ],
        ];

        foreach ($proprietarios as $proprietario) {
            Proprietario::create($proprietario);
        }
    }
}
