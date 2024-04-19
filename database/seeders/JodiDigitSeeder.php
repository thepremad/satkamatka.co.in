<?php

namespace Database\Seeders;

use App\Models\JodiDigit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JodiDigitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $paddedNumber = str_pad($i, 2, '0', STR_PAD_LEFT);
            JodiDigit::create(['digit' => $paddedNumber]);
        }
    }
}
