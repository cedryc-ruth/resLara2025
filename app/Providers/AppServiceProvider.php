<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('index-artist', function (User $user) {
            return $user->role === 'admin' or $user->role === 'member';
        });

        Gate::define('show-artist', function (User $user) {
            return $user->role === 'admin' or $user->role === 'member';
        });

        Gate::define('create-artist', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('update-artist', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('delete-artist', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
