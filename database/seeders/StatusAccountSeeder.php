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
                'color' => 'success',
            ]);
        }
        if (!StatusAccount::where('name', 'Pendente')->first()) {
            StatusAccount::create([
                'name' => 'Pendente',
                'color' => 'warning',
            ]);
        }
        if (!StatusAccount::where('name', 'Urgenmte')->first()) {
            StatusAccount::create([
                'name' => 'Urgente',
                'color' => 'danger',
            ]);
        }
    }
}
