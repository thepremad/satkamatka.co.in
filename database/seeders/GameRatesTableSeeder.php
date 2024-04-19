<?php

namespace Database\Seeders;

use App\Models\GameRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GameRate::create([
            'single_betting_amount' => 10,
            'single_winning_amount' => 95,
            'jodi_betting_amount' => 10,
            'jodi_winning_amount' => 900,
            'single_pana_betting_amount' => 10,
            'single_pana_winning_amount' => 1400,
            'double_pana_betting_amount' => 10,
            'double_pana_winning_amount' => 2800,
            'tripple_pana_betting_amount' => 10,
            'tripple_pana_winning_amount' => 7000,
            'half_sangam_betting_amount' => 10,
            'half_sangam_winning_amount' => 10000,
            'full_sangam_betting_amount' => 10,
            'full_sangam_winning_amount' => 100000
        ]);
    }
}
