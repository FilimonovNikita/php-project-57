<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(?User $user): bool
    {
        return true;//
    }

    public function view(?User $user, Task $task): bool
    {
        return true;
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
    public function update(User $user, Task $task): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        Log::info('User attempting to delete task', ['user' => $user->toArray(), 'task' => $task->toArray()]);
        return Auth::id() === $task->created_by_id;
    }
}
