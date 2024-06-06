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
        Schema::create('tournament_rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_id');
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('winner_id');
            $table->foreign('winner_id')->references('id')->on('winners')->onUpdate('cascade')->onDelete('cascade');
            $table->string('rank')->nullable();
            $table->string('reward_name')->nullable();
            $table->string('reward')->nullable();
            $table->longText('description')->nullable();
            $table->string('reward_code')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_rewards');
    }
};
