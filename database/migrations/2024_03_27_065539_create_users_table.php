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
            $table->unsignedBigInteger('id')->primary()->unique() -> autoIncrement();
            $table->string('firstName', 50);
            $table->string('middleName', 50);
            $table->string('lastName', 50);
            $table->string('mobile', 15);
            $table->string('email', 50);
            $table->string('password', 255);
            $table->dateTime('registedAt');
            $table->dateTime('lastLogin');
            $table->tinyText('intro')->nullable();
            $table->text('profile')->nullable();
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
