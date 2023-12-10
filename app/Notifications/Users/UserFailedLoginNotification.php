<?php

namespace App\Notifications\Users;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFailedLoginNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The request IP address.
     *
     * @var string
     */
    public $ip;

    public $userAgent;

    /**
     * The request IP address.
     *
     * @var \Carbon\Carbon
     */
    public $time;

    /**
     * Create a new notification instance.
     */
    public function __construct($ip, $userAgent)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->time = Carbon::now();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['database'];

        if ($notifiable->hasVerifiedEmail()) {
            $via[] = 'mail';
        }

        return $via;
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'category' => 'user',
            'title' => 'User login failed',
            'description' => 'We Noticed a New Login from '.$this->userAgent.' by ip '.$this->ip.' ('.gethostbyaddr($this->ip).') at '.$this->time,
            'action' => [
                'type' => 'link',
                'params' => [
                    'url' => '',
                    'label' => 'View',
                ],
            ],
        ];
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
            ->error()
            ->subject('Failed Login Notification')
            ->greeting('Account Login Failed!')
            ->line('A failed login was detected for your account.')
            ->line('This request originated from '.$this->userAgent.' by ip '.$this->ip.' ('.gethostbyaddr($this->ip).') at '.$this->time)
            ->line('If this was you, you can safely disregard this email. If this wasn\'t you, you can secure your account here
            Learn more about keeping your account secure.');
    }
}
