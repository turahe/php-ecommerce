<?php

namespace App\Notifications\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $via = ['database'];

        if ($notifiable->hasVerifiedEmail()) {
            $via[] = 'mail';
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->success()
            ->line('Hi there '.$notifiable->username)
            ->line('This notification is on behalf of '.config('app.name').' to let you know that your password has been successfully reset.')
            ->line('If you did not reset your account password, please contact Mailgun Support immediately at '.config('mail.from.address'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'category' => 'user',
            'title' => 'User reset password',
            'description' => 'This notification is on behalf of '.config('app.name').' to let you know that your password has been successfully reset.',
            'action' => [
                'type' => 'link',
                'params' => [
                    'url' => '',
                    'label' => 'View',
                ],
            ],
        ];
    }
}
