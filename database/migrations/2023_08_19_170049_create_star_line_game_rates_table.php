<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('star_line_game_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('single_betting_amount');
            $table->integer('single_winning_amount');
            $table->integer('single_pana_betting_amount');
            $table->integer('single_pana_winning_amount');
            $table->integer('double_pana_betting_amount');
            $table->integer('double_pana_winning_amount');
            $table->integer('tripple_pana_betting_amount');
            $table->integer('tripple_pana_winning_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('star_line_game_rates');
    }
};
