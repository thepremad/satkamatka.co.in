<?php

namespace Database\Seeders;

use App\Models\StarLineGameRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StarLineGameRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StarLineGameRate::create([
            'single_betting_amount' => 10,
            'single_winning_amount' => 95,
            'single_pana_betting_amount' => 10,
            'single_pana_winning_amount' => 1400,
            'double_pana_betting_amount' => 10,
            'double_pana_winning_amount' => 2800,
            'tripple_pana_betting_amount' => 10,
            'tripple_pana_winning_amount' => 7000,
        ]);
    }
}
