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
            $table->text('processor');
            $table->text('motherboard');
            $table->text('ram');
            $table->text('nvmes');
            $table->text('ssds');
            $table->text('gpu');
            $table->text('case');
            $table->text('cooler');
            $table->decimal('total', 10, 2);
            $table->text('type')->nullable();
            $table->text('cover')->nullable();
            $table->text('fans')->nullable();
            $table->text('cont')->nullable();
            $table->text('extra')->nullable();
            $table->timestamps();
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
