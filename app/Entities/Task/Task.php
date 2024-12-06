<?php

namespace App\Entities\Task;

use App\Entities\Task\Helpers\TaskRelationsHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property boolean $completed
 * @property string $user_id
 */
class Task extends Model
{
    use HasFactory,
        TaskRelationsHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'completed',
        'user_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean',
    ];
}
