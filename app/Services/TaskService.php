<?php

namespace App\Services;

use App\Services\Contracts\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskServiceInterface
{

    public function getAll(): Collection
    {
        return Task::all();
    }

    public function getById($id): Task
    {
        return Task::findOrFail($id);
    }

    public function getCompletedTasks(): array
    {
        return Task::where('is_completed', true)->get()->all();
    }

    public function create($request): Task
    {
        return Task::create($request->validated());
    }

    public function update($request): Task
    {
        $task = $this->getById($request->get('id'));

        $data = $request->validated();

        $data['name'] = $data['name'] ?? $task->name;
        $data['is_completed'] = $data['is_completed'] ?? $task->is_completed;

        $task->update($data);

        return $task;
    }

    public function delete($id): bool
    {
        Task::where('id', $id)->delete();
        return true;
    }
}
