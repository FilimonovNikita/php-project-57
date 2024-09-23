<?php

namespace App\Policies;

use App\Models\TaskLabel;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskLabelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return true; // или ваша логика проверки
    }

    public function view(User $user, TaskLabel $taskLabel)
    {
        return true; // или ваша логика проверки
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Auth::check();//
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TaskLabel $taskLabel): bool
    {
        return Auth::check();//
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskLabel $taskLabel): bool
    {
        return Auth::check();//
    }
}
