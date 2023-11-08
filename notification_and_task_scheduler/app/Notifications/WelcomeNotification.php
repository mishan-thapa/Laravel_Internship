<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    protected $user_name;
    public function __construct(User $user)
    {
        $this->user_name = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hello!'. $this->userName . '!')
                    ->from('kshetrimishan123@gmail.com', 'mishan')
                    ->subject('laravel intern')
                    ->line('The introduction to the notification.')
                    ->action('click this link', url('/'))
                    ->line('Thank you for using our application!')
                    ->attach('/Users/mishanthapakshetri/Documents/internship/laravel_notification/yami.jpg', [
                        'as' => 'yami.jpg',
                        'mime' => 'application/jpg',
                    ]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
