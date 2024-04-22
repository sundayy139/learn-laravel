<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostComment;
use App\Models\PostMeta;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Post::factory(50)->create();
        Category::factory(50)->create();
        Tag::factory(50)->create();
        PostMeta::factory(50)->create();
        PostComment::factory(50)->create();
        PostTag::factory(50)->create();
        PostCategory::factory(50)->create();
    }
}
