<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(
//            \Illuminate\Notifications\Channels\DatabaseChannel::class,
//            \App\Notifications\DatabaseChannel::class
//        );

        Relation::enforceMorphMap([
            'user' => 'App\Models\User',
            'post' => 'App\Models\Post',
            'comment' => 'App\Models\Comment',
            'permission' => 'App\Models\Permission',
            'role' => 'App\Models\Role',
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
