<?php

namespace Database\Seeders;

use App\Models\Veiculo;
use Illuminate\Database\Seeder;

class VeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $veiculos = [
            // Veículos do João (id: 1)
            ['proprietario_id' => 1, 'modelo' => 'Civic', 'placa' => 'ABC1234', 'marca' => 'Honda'],
            ['proprietario_id' => 1, 'modelo' => 'Fit', 'placa' => 'XYZ5678', 'marca' => 'Honda'],

            // Veículos da Maria (id: 2)
            ['proprietario_id' => 2, 'modelo' => 'Onix', 'placa' => 'DEF9012', 'marca' => 'Chevrolet'],

            // Veículos do Carlos (id: 3)
            ['proprietario_id' => 3, 'modelo' => 'Corolla', 'placa' => 'GHI3456', 'marca' => 'Toyota'],
            ['proprietario_id' => 3, 'modelo' => 'Hilux', 'placa' => 'JKL7890', 'marca' => 'Toyota'],
            ['proprietario_id' => 3, 'modelo' => 'Etios', 'placa' => 'MNO1234', 'marca' => 'Toyota'],

            // Veículos da Ana (id: 4)
            ['proprietario_id' => 4, 'modelo' => 'Gol', 'placa' => 'PQR5678', 'marca' => 'Volkswagen'],

            // Veículos do Pedro (id: 5)
            ['proprietario_id' => 5, 'modelo' => 'HB20', 'placa' => 'STU9012', 'marca' => 'Hyundai'],
            ['proprietario_id' => 5, 'modelo' => 'Creta', 'placa' => 'VWX3456', 'marca' => 'Hyundai'],

            // Veículos da Juliana (id: 6)
            ['proprietario_id' => 6, 'modelo' => 'Sandero', 'placa' => 'YZA7890', 'marca' => 'Renault'],
        ];

        foreach ($veiculos as $veiculo) {
            Veiculo::create($veiculo);
        }
    }
}
