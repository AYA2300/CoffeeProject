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
        Schema::create('order__items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('coffee_id')->constrained('coffees')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->enum('volume_ml',['250','350','450']);
            $table->boolean('prepare_by_time')->default(false);
            $table->timestamp('prepare_time')->nullable();
            $table->enum('onsite_takeaway', ['onsite', 'takeaway']);
            $table->enum('ristretto',['1','2']);
            $table->string('total_amount')->default('0');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order__items');
    }
};
