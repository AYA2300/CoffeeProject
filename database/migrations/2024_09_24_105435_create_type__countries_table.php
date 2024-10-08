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
        Schema::create('type__countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coffee_type_id')->constrained('coffee_types');
            $table->foreignId('coffee_country_id')->constrained('coffee_countries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type__countries');
    }
};
