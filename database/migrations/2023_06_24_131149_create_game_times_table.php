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
        Schema::create('game_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('game_name_id')->unsigned()->nullable();
            $table->foreign('game_name_id')->references('id')->on('game_names')->onDelete('cascade');
            $table->string('day_of_week');
            $table->time('open_time');
            $table->time('close_time');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_times');
    }
};
