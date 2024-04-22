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
        Schema::create('post_metas', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->unique() -> autoIncrement();
            $table->unsignedBigInteger('postId');
            $table->string('key', 50);
            $table->text('content');
        });

        Schema::table('post_metas', function (Blueprint $table) {
            $table->foreign('postId')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_metas');
    }
};
