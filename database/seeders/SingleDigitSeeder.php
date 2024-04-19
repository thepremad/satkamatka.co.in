<?php

namespace Database\Seeders;

use App\Models\SingleDigit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SingleDigitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 9; $i++) {
            SingleDigit::create(['digit' => $i]);
        }
    }
}
