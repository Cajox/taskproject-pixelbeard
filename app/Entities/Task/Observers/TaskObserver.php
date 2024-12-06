<?php

namespace App\Entities\Task\Observers;

use App\Entities\Task\Task;
use App\Entities\User\User;
use Illuminate\Auth\AuthenticationException;
//use Illuminate\Support\Facades\Auth;

class TaskObserver
{
    /**
     * Handle the Task "creating" event.
     *
     * @param Task $task
     * @return void
     * @throws AuthenticationException
     */
    public function creating(Task $task): void
    {
        //Take first user because we didn't implement Auth
        $user = User::first(); // Auth::user();

        if (!$user) {
            throw new AuthenticationException('User must be authenticated to create a task.');
        }

        $task->user_id = $user->id;
    }}
