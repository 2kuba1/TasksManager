<?php

namespace App\Services;

use App\Services\Contracts\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskServiceInterface
{

    public function getAll(): Collection
    {
        return Task::where('user_id', '=', auth()->user()->id)->get();
    }

    public function getById($id): Task
    {
        $task = $this->getById($id);

        if($task['user_id'] != auth()->user()->id) {
            abort(400);
        }

        return Task::findOrFail($id);
    }

    public function getCompletedTasks(): array
    {
        return Task::where('is_completed', true)->get()->all();
    }

    public function create($request, int $id): Task
    {
        $validatedRequest = $request->validated();

        return Task::create([
            'name' =>  $validatedRequest['name'],
            'is_completed' => $validatedRequest['is_completed'],
            'user_id' => $id,
        ]);
    }

    public function update($request): Task
    {
        $task = $this->getById($request->get('id'));

        if($task['user_id'] != auth()->user()->id) {
            abort(400);
        }

        $data = $request->validated();

        $data['name'] = $data['name'] ?? $task->name;
        $data['is_completed'] = $data['is_completed'] ?? $task->is_completed;

        $task->update($data);

        return $task;
    }

    public function delete($id): bool
    {
        $task = $this->getById($id);

        if($task['user_id'] != auth()->user()->id) {
            abort(400);
        }

        $task->delete();
        return true;
    }
}
