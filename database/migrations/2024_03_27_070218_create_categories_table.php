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
        Schema::create('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->unique() -> autoIncrement();
            $table->unsignedBigInteger('parentId')->nullable();
            $table->string('title', 75);
            $table->string('metaTitle', 100)->nullable();
            $table->string('slug', 100);
            $table->text('content')->nullable();
        });


        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parentId')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
