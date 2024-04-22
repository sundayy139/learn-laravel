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
        Schema::create('post_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->unique() -> autoIncrement();
            $table->unsignedBigInteger('postId');
            $table->unsignedBigInteger('parentId')->nullable();;
            $table->string('title', 75);
            $table->tinyInteger('published')->default(0);
            $table->dateTime('createdAt');
            $table->dateTime('publishedAt');
            $table->text('content');
        });

        Schema::table('post_comments', function (Blueprint $table) {
            $table->foreign('postId')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('parentId')->references('id')->on('post_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};
