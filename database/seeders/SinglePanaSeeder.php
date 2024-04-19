<?php

namespace Database\Seeders;

use App\Models\SinglePana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SinglePanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numbers = [
            [0 => 127, 136, 145, 190, 235, 280, 370, 389, 460, 479, 569, 578],
            [1 => 128, 137, 146, 236, 245, 290, 380, 470, 489, 560, 579, 678],
            [2 => 129, 138, 147, 156, 237, 246, 345, 390, 480, 570, 589, 679],
            [3 => 120, 139, 148, 157, 238, 247, 256, 346, 490, 580, 670, 689],
            [4 => 130, 149, 158, 167, 239, 248, 257, 347, 356, 590, 680, 789],
            [5 => 140, 159, 168, 230, 249, 258, 267, 348, 357, 456, 690, 780],
            [6 => 123, 150, 169, 178, 240, 259, 268, 349, 358, 367, 457, 790],
            [7 => 124, 160, 278, 179, 250, 269, 340, 359, 368, 458, 467, 890],
            [8 => 125, 134, 170, 189, 260, 279, 350, 369, 468, 378, 459, 567],
            [9 => 126, 135, 180, 234, 270, 289, 360, 379, 450, 469, 478, 568],
        ];

        foreach ($numbers as $row) {
            // foreach ($row as $number) {
                SinglePana::create([
                    'digit' => $row,
                ]);
            // }
        }
    }
}
