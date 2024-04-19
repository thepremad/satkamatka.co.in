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
        Schema::create('value_masters', function (Blueprint $table) {
            $table->id();
            $table->float('min_deposite')->default(0);
            $table->float('max_deposite')->default(0);
            $table->float('min_withdrawal')->default(0);
            $table->float('max_withdrawal')->default(0);
            $table->float('min_transfer')->default(0);
            $table->float('max_transfer')->default(0);
            $table->float('min_bid_amount')->default(0);
            $table->float('max_bid_amount')->default(0);
            $table->float('welcome_bonus')->default(0);
            $table->time('withdrawal_open_time')->nullable();
            $table->time('withdrawal_close_time')->nullable();
            $table->enum('global_batting', ['0', '1'])->default('1')->comment('1 = Yes, 0 = No ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('value_masters');
    }
};
