<?php

namespace App\Entities\Task\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllTasks(): Collection;

    /**
     * @param int $id
     * @return Model|null
     */
    public function getTaskById(int $id): ?Model;

    /**
     * @param array $data
     * @return Model
     */
    public function createTask(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function updateTask(int $id, array $data): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteTask(int $id): bool;
}
