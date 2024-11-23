<?php

namespace Database\Seeders;

use App\Models\StatusAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!StatusAccount::where('name', 'Paga')->first()) {
            StatusAccount::create([
                'name' => 'Paga',
                'color' => '#28a745', // Verde-escuro
            ]);
        }
        if (!StatusAccount::where('name', 'Pendente')->first()) {
            StatusAccount::create([
                'name' => 'Pendente',
                'color' => '#ffc107', // Amarelo
            ]);
        }
        if (!StatusAccount::where('name', 'Urgente')->first()) {
            StatusAccount::create([
                'name' => 'Urgente',
                'color' => '#dc3545', // Vermelho intenso
            ]);
        }
        if (!StatusAccount::where('name', 'Cancelada')->first()) {
            StatusAccount::create([
                'name' => 'Cancelada',
                'color' => '#6c757d', // Cinza-claro
            ]);
        }
        if (!StatusAccount::where('name', 'Atrasada')->first()) {
            StatusAccount::create([
                'name' => 'Atrasada',
                'color' => '#fd7e14', // Laranja-escuro
            ]);
        }
    }
}