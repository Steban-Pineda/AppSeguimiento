<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFour();

        // Ocultar menú a aprendices (role 3)
        Gate::define('solo-admin-instructor', function ($user) {
            return $user->role !== 3;
        });
    }
}
