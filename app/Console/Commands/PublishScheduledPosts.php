<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish';
    protected $description = 'Publish scheduled posts';

    public function handle()
    {
        // Fetch scheduled posts whose scheduled_at time has passed
        $scheduledPosts = Blog::where('is_scheduled', true)
            ->where('scheduled_at', '<=', now())
            ->get();

        echo "Number of scheduled posts: " . count($scheduledPosts) . PHP_EOL;

        // Update status of scheduled posts to make them visible
        foreach ($scheduledPosts as $blog) {
            $blog->update([
                'is_scheduled' => false,
            ]);
        }
    }
}
