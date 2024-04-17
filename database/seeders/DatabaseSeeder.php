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
        User::factory(10)->create();
        Post::factory(10)->create();
        Category::factory(10)->create();
        PostComment::factory(10)->create();
        PostMeta::factory(10)->create();
        Tag::factory(10)->create();
        PostTag::factory(10)->create();
        PostCategory::factory(10)->create();
    }
}
