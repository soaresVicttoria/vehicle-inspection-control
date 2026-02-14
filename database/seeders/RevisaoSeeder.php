<?php

namespace Database\Seeders;

use App\Models\Revisao;
use Illuminate\Database\Seeder;

class RevisaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $revisoes = [
            // Revisões do Civic (veiculo_id: 1)
            ['veiculo_id' => 1, 'data_revisao' => '2023-01-15', 'duracao_servico' => 120],
            ['veiculo_id' => 1, 'data_revisao' => '2023-07-20', 'duracao_servico' => 90],
            ['veiculo_id' => 1, 'data_revisao' => '2024-01-10', 'duracao_servico' => 150],
            ['veiculo_id' => 1, 'data_revisao' => '2024-08-05', 'duracao_servico' => 100],

            // Revisões do Fit (veiculo_id: 2)
            ['veiculo_id' => 2, 'data_revisao' => '2023-03-10', 'duracao_servico' => 80],
            ['veiculo_id' => 2, 'data_revisao' => '2023-09-15', 'duracao_servico' => 95],
            ['veiculo_id' => 2, 'data_revisao' => '2024-03-20', 'duracao_servico' => 110],

            // Revisões do Onix (veiculo_id: 3)
            ['veiculo_id' => 3, 'data_revisao' => '2023-02-05', 'duracao_servico' => 130],
            ['veiculo_id' => 3, 'data_revisao' => '2023-08-10', 'duracao_servico' => 85],
            ['veiculo_id' => 3, 'data_revisao' => '2024-02-15', 'duracao_servico' => 140],

            // Revisões do Corolla (veiculo_id: 4)
            ['veiculo_id' => 4, 'data_revisao' => '2023-04-20', 'duracao_servico' => 160],
            ['veiculo_id' => 4, 'data_revisao' => '2023-10-25', 'duracao_servico' => 120],
            ['veiculo_id' => 4, 'data_revisao' => '2024-05-01', 'duracao_servico' => 135],

            // Revisões da Hilux (veiculo_id: 5)
            ['veiculo_id' => 5, 'data_revisao' => '2023-05-12', 'duracao_servico' => 180],
            ['veiculo_id' => 5, 'data_revisao' => '2023-11-18', 'duracao_servico' => 145],
            ['veiculo_id' => 5, 'data_revisao' => '2024-06-10', 'duracao_servico' => 170],

            // Revisões do Etios (veiculo_id: 6)
            ['veiculo_id' => 6, 'data_revisao' => '2024-01-20', 'duracao_servico' => 75],
            ['veiculo_id' => 6, 'data_revisao' => '2024-07-25', 'duracao_servico' => 90],

            // Revisões do Gol (veiculo_id: 7)
            ['veiculo_id' => 7, 'data_revisao' => '2023-06-05', 'duracao_servico' => 100],
            ['veiculo_id' => 7, 'data_revisao' => '2024-01-08', 'duracao_servico' => 115],

            // Revisões do HB20 (veiculo_id: 8)
            ['veiculo_id' => 8, 'data_revisao' => '2023-07-15', 'duracao_servico' => 95],
            ['veiculo_id' => 8, 'data_revisao' => '2024-02-20', 'duracao_servico' => 105],

            // Revisões da Creta (veiculo_id: 9)
            ['veiculo_id' => 9, 'data_revisao' => '2023-08-22', 'duracao_servico' => 125],
            ['veiculo_id' => 9, 'data_revisao' => '2024-03-28', 'duracao_servico' => 130],

            // Revisões do Sandero (veiculo_id: 10)
            ['veiculo_id' => 10, 'data_revisao' => '2023-09-30', 'duracao_servico' => 85],
            ['veiculo_id' => 10, 'data_revisao' => '2024-04-15', 'duracao_servico' => 92],
        ];

        foreach ($revisoes as $revisao) {
            Revisao::create($revisao);
        }
    }
}
