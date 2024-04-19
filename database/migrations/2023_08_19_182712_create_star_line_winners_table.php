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
        Schema::create('star_line_winners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('bid_id');
            $table->unsignedBigInteger('game_result_id');
            $table->string('bid_type')->nullable();
            $table->string('session')->nullable()->comment('open close');
            $table->integer('game_number');
            $table->integer('point_quantity')->default(0);
            $table->decimal('winning_amount',8,2)->default(0.00);
            $table->dateTime('winning_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('star_line_winners');
    }
};
