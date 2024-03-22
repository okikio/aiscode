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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('login_type',['normal','social'])->default('normal')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('affiliate_code');
            $table->unsignedBigInteger('affiliate_id')->nullable();
            $table->foreign('affiliate_id')->references('id')->on('affiliate_ads')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email',100);
            $table->string('password')->nullable();
            $table->string('phone_number',25)->nullable();
            $table->string('image')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('isActive',['0','1'])->default('0');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
