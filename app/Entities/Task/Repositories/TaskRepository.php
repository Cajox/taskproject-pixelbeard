<?php

namespace App\Entities\Task\Repositories;

use App\Entities\Task\Repositories\Interfaces\TaskRepositoryInterface;
use App\Entities\Task\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(protected Task $taskModel)
    {
    }

    /**
     * Get all tasks
     *
     * @return Collection
     */
    public function getAllTasks(): Collection
    {
        return $this->taskModel::with('user')->get();
    }

    /**
     * Get task by id
     *
     * @param int $id
     * @return Model|null
     */
    public function getTaskById(int $id): ?Model
    {
        return $this->taskModel::with('user')->findOrFail($id);
    }

    /**
     * Create task
     *
     * @param array $data
     * @return Model
     */
    public function createTask(array $data): Model
    {
        return $this->taskModel::create($data);
    }

    /**
     * Update task
     *
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function updateTask(int $id, array $data): Model
    {
        $task = $this->taskModel::findOrFail($id);
        $task->update($data);

        return $task;
    }

    /**
     * Delete task
     *
     * @param int $id
     * @return bool
     */
    public function deleteTask(int $id): bool
    {
        $task = $this->taskModel::findOrFail($id);

        return $task->delete();
    }
}
