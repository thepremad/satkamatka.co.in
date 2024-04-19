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
        Schema::create('jodi_digits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('digit', 3)->default('000')->comment('The digit column can have values from 00 to 100');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jodi_digits');
    }
};
