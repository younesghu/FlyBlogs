<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BlogLiked extends Notification
{
    use Queueable;

    protected $blog;
    protected $likeUser;
    public function __construct($blog, $likeUser)
    {
        $this->blog = $blog;
        $this->likeUser = $likeUser;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'blog_id' => $this->blog->id,
            'message' => '<b>' . $this->likeUser->name . '</b> has liked your blog: "' . $this->blog->title . '".'
        ];
    }
}
