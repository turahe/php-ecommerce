<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        \Illuminate\Auth\Events\Registered::class => [
            \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
        ],
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\Users\UserLoginListener::class,
        ],
        \Illuminate\Auth\Events\Failed::class => [
            \App\Listeners\Users\UserFailedLoginListener::class,
        ],
        \Illuminate\Auth\Events\Logout::class => [
            \App\Listeners\Users\UserLogoutListener::class,
        ],
        \Illuminate\Auth\Events\Lockout::class => [
            \App\Listeners\Users\UserLoginListener::class,
        ],
        \Illuminate\Auth\Events\PasswordReset::class => [
            \App\Listeners\Users\UserPasswordReset::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
