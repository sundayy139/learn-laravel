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
        Schema::create('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->unique() -> autoIncrement();
            $table->string('title', 75);
            $table->string('metaTitle', 100) -> nullable();
            $table->string('slug', 100);
            $table->text('content')-> nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
