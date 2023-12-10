<?php

namespace App\Listeners\Users;

use App\Notifications\Users\ResetPasswordNotification;
use Illuminate\Http\Request;
use Laravel\Jetstream\Agent;

class UserPasswordReset
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly Agent $agent, private readonly Request $request)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->user->hasVerifiedEmail()) {
            $event->user->notify(new ResetPasswordNotification());
            activity()
                ->useLog('user_reset')
                ->performedOn($event->user)
                ->causedBy($event->user)
                ->withProperties([
                    'ip' => $this->request->ip(),
                    'browser' => $this->agent->browser(),
                    'device' => $this->agent->device(),
                    'platform' => $this->agent->platform(),
                    'version' => [
                        'browser' => $this->agent->version($this->agent->browser()),
                        'platform' => $this->agent->version($this->agent->platform()),
                    ],
                ])
                ->log('User reset password');
        }
    }
}
