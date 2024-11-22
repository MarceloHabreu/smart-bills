<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('accounts')->insert([
                'name' => $faker->name,
                'value' => $faker->randomFloat(2, 100, 10000), // Valor entre 100 e 10000
                'due_date' => $faker->dateTimeBetween('now', '+1 year'),
                'status_account_id' => $faker->randomElement([1, 2, 3]), // Valores 1, 2 ou 3
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
