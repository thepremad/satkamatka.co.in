<?php

namespace Database\Seeders;

use App\Models\DoublePana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoublePanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numbers = [
            [0 => 550, 668, 244, 299, 226, 488, 677, 118, 334],
            [1 => 100, 119, 155, 227, 335, 344, 399, 588, 669],
            [2 => 200, 110, 228, 255, 336, 499, 660, 688, 778],
            [3 => 300, 166, 229, 337, 355, 445, 599, 779, 788],
            [4 => 400, 112, 220, 266, 338, 446, 455, 699, 770],
            [5 => 500, 113, 122, 177, 339, 366, 447, 799, 889],
            [6 => 600, 114, 277, 330, 448, 466, 556, 880, 899],
            [7 => 700, 115, 133, 188, 223, 377, 449, 557, 566],
            [8 => 800, 116, 224, 233, 288, 440, 477, 558, 990],
            [9 => 900, 117, 144, 199, 225, 388, 559, 577, 667],
        ];

        foreach ($numbers as $row) {
            // foreach ($row as $number) {
                DoublePana::create([
                    'digit' => $row,
                ]);
            // }
        }
    }
}
