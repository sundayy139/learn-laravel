<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class UpdateStatusPublished extends Command
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
    
        try {
            Post::where('publishedAt', '<', Carbon::now())->update(['published' => 1]);
    
            $this->info('Publish status updated for eligible posts.');
        } catch (\Exception $e) {
            $this->error('Error updating publish status: ' . $e->getMessage());
        }
    }
}