<?php

namespace App\Entities\Task\Services;

use App\Entities\Task\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TaskService
{
    public function __construct(protected TaskRepositoryInterface $taskRepository)
    {
    }

    /**
     * Get all tasks
     *
     * @return Collection
     */
    public function getAllTasks(): Collection
    {
        // Business logic here
        return $this->taskRepository->getAllTasks();
    }

    /**
     * Get task by ID
     *
     * @param int $id
     * @return Model|null
     */
    public function getTaskById(int $id): ?Model
    {
        // Business logic here
        return $this->taskRepository->getTaskById($id);
    }

    /**
     * Create a new task
     *
     * @param array $data
     * @return mixed
     */
    public function createTask(array $data): Model
    {
        // Business logic here
        return $this->taskRepository->createTask($data);
    }

    /**
     * Update a task
     *
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function updateTask(int $id, array $data): Model
    {
        // Business logic here
        return $this->taskRepository->updateTask($id, $data);
    }

    /**
     * Delete a task
     *
     * @param int $id
     * @return bool
     */
    public function deleteTask(int $id): bool
    {
        // Business logic here
        return $this->taskRepository->deleteTask($id);
    }
}
