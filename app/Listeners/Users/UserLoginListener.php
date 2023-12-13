<?php

namespace App\Listeners\Users;

use App\Notifications\Users\UserLoginNotification as Notification;
use Illuminate\Http\Request;
use Laravel\Jetstream\Agent;

class UserLoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly Request $request)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->user->hasVerifiedEmail()) {
//            $event->user->notify(new Notification($this->request->ip(), $this->request->userAgent()));
            activity()
                ->useLog('user_login')
                ->performedOn($event->user)
                ->causedBy($event->user)
                ->withProperties([
                    'ip' => $this->request->ip(),
//                    'browser' => $this->request->browser(),
//                    'device' => $this->agent->device(),
//                    'platform' => $this->agent->platform(),
//                    'version' => [
//                        'browser' => $this->agent->version($this->agent->browser()),
//                        'platform' => $this->agent->version($this->agent->platform()),
//                    ],
                ])
                ->log('User login to system');
        }
    }
}
