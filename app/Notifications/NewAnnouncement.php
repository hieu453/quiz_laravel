<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewAnnouncement extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected $messages,
        protected $userIds
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'     =>  $this->messages['title'],
            'body'      =>  $this->messages['body'],
            'link'      =>  $this->messages['link'],
            'linkText'  =>  $this->messages['linkText'],
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title'     => $this->messages['title'],
            'body'      => $this->messages['body'],
            'link'      => $this->messages['link'],
            'linkText'  => $this->messages['linkText'],
            'sentUsers' => $this->userIds
        ]);
    }

    public function broadcastOn()
    {
        return [
            new Channel('all')
        ];
    }
}
