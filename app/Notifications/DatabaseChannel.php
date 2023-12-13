<?php

namespace App\Notifications;
use Illuminate\Notifications\Channels\DatabaseChannel as BaseDatabaseChannel;
use Illuminate\Notifications\Notification;
class DatabaseChannel extends BaseDatabaseChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function send($notifiable, Notification $notification)
    {
        $adminNotificationId = null;
        if (method_exists($notification, 'getAdminNotificationId')) {
            $adminNotificationId = $notification->getAdminNotificationId();
        }

        return $notifiable->routeNotificationFor('database')->create([
            'id' => $notification->id,
            'type' => get_class($notification),
            'data' => $this->getData($notifiable, $notification),

            // ** New custom field **
//            'admin_notification_id' => $adminNotificationId,

            'read_at' => null,
        ]);
    }

}
