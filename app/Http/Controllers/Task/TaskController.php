<?php
namespace App\Http\Controllers\Task;

use App\Entities\Task\Resources\TaskResource;
use App\Entities\Task\Services\TaskService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Task\Requests\CreateTaskRequest;
use App\Http\Controllers\Task\Requests\UpdateTaskRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(
            $this->taskService->getAllTasks()
        );
    }

    /**
     * @param int $id
     * @return TaskResource
     */
    public function show(int $id): TaskResource
    {
        return new TaskResource(
            $this->taskService->getTaskById($id)
        );
    }

    /**
     * @param CreateTaskRequest $request
     * @return TaskResource
     */
    public function store(CreateTaskRequest $request): TaskResource
    {
        return new TaskResource(
            $this->taskService->createTask($request->validated())
        );
    }

    /**
     * @param UpdateTaskRequest $request
     * @param int $id
     * @return TaskResource
     */
    public function update(UpdateTaskRequest $request, int $id): TaskResource
    {
        return new TaskResource(
            $this->taskService->updateTask($id, $request->validated())
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->taskService->deleteTask($id);

        return response()->json(status: 204);
    }
}
