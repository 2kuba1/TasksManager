<?php

namespace App\Services\Contracts;

use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    public function getAll() : Collection;
    public function getById($id): Task;
    public function getCompletedTasks(): array;
    public function create($request) : Task;
    public function update(UpdateTaskRequest $request) : Task;
    public function delete($id) : bool;
}
