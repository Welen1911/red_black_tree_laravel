<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10000; $i++) {
            Produto::create([
                'descricao' => "Produto {$i}",
                'valor' => rand(1, 200), // Gera valores entre 1 e 200
            ]);
        }
    }
}
