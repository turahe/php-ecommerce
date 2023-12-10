<?php

namespace App\Listeners\Users;

use Illuminate\Http\Request;
use Laravel\Jetstream\Agent;

class UserLogoutListener
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
        activity()
            ->useLog('user_logout')
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
            ->log('User logout to system');

    }
}
