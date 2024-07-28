<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BlogCommented extends Notification
{
    use Queueable;

    protected $blog;
    protected $comment;
    protected $commentUser;

    /**
     * Create a new notification instance.
     */
    public function __construct($blog, $comment, $commentUser)
    {
        $this->blog = $blog;
        $this->comment = $comment;
        $this->commentUser = $commentUser;
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
            'message' => '<b>' . $this->commentUser->name . '</b> has commented in your blog: "' . $this->blog->title . '".',
            'comment' => $this->comment->content
        ];
    }
}
