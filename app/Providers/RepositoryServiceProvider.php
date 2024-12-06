<?php

namespace App\Providers;

use App\Entities\Task\Observers\TaskObserver;
use App\Entities\Task\Repositories\Interfaces\TaskRepositoryInterface;
use App\Entities\Task\Repositories\TaskRepository;
use App\Entities\Task\Task;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Task::observe(TaskObserver::class);
    }
}
