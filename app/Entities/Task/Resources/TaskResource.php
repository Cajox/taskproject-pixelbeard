<?php

namespace App\Entities\Task\Resources;

use App\Entities\User\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property bool $completed
 * @property Model|null $user
 */
class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'completed'   => $this->completed,
            'user'        => $this->whenLoaded('user', fn() => new UserResource($this->user)),
        ];
    }
}
