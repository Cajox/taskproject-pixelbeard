<?php

namespace App\Entities\User\Helpers;

use App\Entities\Task\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelationsTrait
{
    /**
     * One user can have multiple tasks
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
