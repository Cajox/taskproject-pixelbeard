<?php

namespace App\Entities\User;

use App\Entities\User\Helpers\UserRelationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $name
 */
class User extends Authenticatable
{
    use HasFactory,
        UserRelationsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
}
