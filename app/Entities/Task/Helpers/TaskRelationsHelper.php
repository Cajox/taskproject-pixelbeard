<?php
namespace App\Entities\Task\Helpers;

use App\Entities\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TaskRelationsHelper
{
    /**
     * Task belongs to User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
