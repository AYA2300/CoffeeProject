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
        Schema::create('user_rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // العلاقة مع المستخدم
             $table->foreignId('reward_id')->constrained('rewards')->onDelete('cascade'); // العلاقة مع المكافأة
             $table->string('points_redeemed'); // عدد النقاط المستردة
             $table->timestamp('redeemed_at'); // وقت استرداد المكافأة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rewards');
    }
};
