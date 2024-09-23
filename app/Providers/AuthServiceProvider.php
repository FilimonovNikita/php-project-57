<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\TaskLabel;
use App\Models\Task;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\TaskStatus;
use App\Policies\TaskLabelPolicy;
use App\Policies\TaskPolicy;
use App\Policies\TaskStatusPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        TaskStatus::class => TaskStatusPolicy::class,
        Task::class => TaskPolicy::class,
        TaskLabel::class => TaskLabelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
