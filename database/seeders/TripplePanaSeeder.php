<?php

namespace Database\Seeders;

use App\Models\TripplePana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripplePanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            '000',
            '111',
            '222',
            '333',
            '444',
            '555',
            '666',
            '777',
            '888',
            '999',
        ];

        foreach ($values as $value) {
            TripplePana::create([
                'digit' => $value,
            ]);
        }
    }
}
