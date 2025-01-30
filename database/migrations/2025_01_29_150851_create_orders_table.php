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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained() 
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->foreignId('status_id')
                ->constrained() 
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->unsignedInteger('uuid')->unique();
            $table->dateTime('order_date');
            $table->timestamps();

            $table->index('order_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
