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
        Schema::create('star_line_game_names', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_hindi')->nullable();
            $table->time('today_open_time');
            $table->boolean('status')->default(true);
            $table->string('market_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('star_line_game_names');
    }
};
