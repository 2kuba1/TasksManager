<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\DeleteTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\Contracts\TaskServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;


class TaskController extends Controller
{
    protected TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService){
        $this->taskService = $taskService;
    }

    public function getAll()
    {
        if (Gate::denies('getAll', Task::class)) {
            abort(403);
        }

        return TaskResource::collection($this->taskService->getAll());
    }

    public function getById($id): TaskResource
    {
        return new TaskResource($this->taskService->getById($id));
    }

    public function getCompleted()
    {
        return TaskResource::collection($this->taskService->getCompletedTasks());
    }

    public function create(StoreTaskRequest  $request) : JsonResource
    {
        $task = $this->taskService->create($request);
        return $task->toResource();
    }

    public function update(UpdateTaskRequest $request) : JsonResource
    {
        $updatedTask = $this->taskService->update($request);
        return $updatedTask->toResource();
    }

    public function delete(DeleteTaskRequest $request) : Response
    {
        $this->taskService->delete($request->input('id'));
        return response()->noContent();
    }
}
