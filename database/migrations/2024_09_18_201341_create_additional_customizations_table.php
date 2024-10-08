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
        Schema::create('additional_customizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order__items')->onDelete('cascade');
            $table->foreignId('milk_type_id')->nullable()->constrained('milk_types');
            $table->foreignId('coffee_type_id')->nullable()->constrained('coffee_types');
            $table->foreignId('additive_id')->nullable()->constrained('additives');
            $table->foreignId('syrup_id')->nullable()->constrained('syrups');
            $table->enum('roasting', ['1', '2', '3'])->nullable();
            $table->enum('grinding', ['little', 'medium'])->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_customizations');
    }
};
