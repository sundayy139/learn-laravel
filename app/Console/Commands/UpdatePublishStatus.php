<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class UpdatePublishStatus extends Command
{
    protected $signature = 'publish:update';

    protected $description = 'Update publish status of posts based on publishedAt.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Start updating publish status...');

        $posts = Post::where('publishedAt', '<', Carbon::now())->get();

        foreach ($posts as $post) {
            $post->published = 1;
            $post->save();
        }

        $this->info('Publish status updated for eligible posts.');
    }
}