<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Group\GroupInterface;
use App\Repositories\Group\GroupRepository;
use App\Repositories\Password\PasswordInterface;
use App\Repositories\Password\PasswordRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(GroupInterface::class, GroupRepository::class);
        $this->app->bind(PasswordInterface::class, PasswordRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
    }
}
