<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(Category::class, CategoryPolicy::class);

        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        Gate::define('users.manage', fn($user) => $user->hasPermission('users.manage'));
        Gate::define('products.create', fn($user) => $user->hasPermission('products.create'));
        Gate::define('products.update', fn($user) => $user->hasPermission('products.update'));
        Gate::define('categories.create', fn($user) => $user->hasPermission('categories.create'));
        Gate::define('categories.update', fn($user) => $user->hasPermission('categories.update'));
    }
}
