<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class YourReplyLiked extends Notification
{
    use Queueable;

    public $discussion;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($d)
    {
        $this->discussion = $d;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your reply on a discussion was liked.')
                    ->action('View Discussion', route('discussions', ['slug' => $this->discussion->slug]))
                    ->line('Thank you for using our application!');
    }
}
