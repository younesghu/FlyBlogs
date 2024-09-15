<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use App\Http\Controllers\Auth\TwitterController;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish';
    protected $description = 'Publish scheduled posts';
    protected $twitterController;

    // Use dependency injection for TwitterController
    public function __construct(TwitterController $twitterController)
    {
        parent::__construct();
        $this->twitterController = $twitterController;
    }

    public function handle()
    {
        // Fetch scheduled posts whose scheduled_at time has passed
        $scheduledPosts = Blog::where('is_scheduled', true)
            ->where('scheduled_at', '<=', now())
            ->get();

        echo "Number of scheduled posts: " . count($scheduledPosts) . PHP_EOL;

        // Update status of scheduled posts to make them visible and share on Twitter if needed
        foreach ($scheduledPosts as $blog) {
            $blog->update([
                'is_scheduled' => false,
                'posted_at' => now(),
            ]);

            // Get the blog's owner (user)
            $owner = $blog->user;

            // If the post should be shared on Twitter and the user has valid Twitter tokens
            if ($owner && $owner->twitter_token && $owner->twitter_token_secret) {
                try {
                    // Post the blog as a tweet on behalf of the user
                    $this->twitterController->postBlogAsTweet($blog, $owner->id);

                    // Log success message
                    echo "Blog post {$blog->id} shared on Twitter successfully" . PHP_EOL;
                } catch (\Exception $e) {
                    // Log an error if posting to Twitter fails
                    \Log::error("Failed to post blog {$blog->id} on Twitter", ['error' => $e->getMessage()]);
                }
            }
        }
    }
}
