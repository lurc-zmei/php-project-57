<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatus = TaskStatus::orderBy('id')->get();

        return view('task_statuses', compact('taskStatus'));
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function store(StoreTaskStatusRequest $request)
    {
        $validated = $request->validated();

        TaskStatus::create($validated);

        flash('Статус успешно создан')->success();

        return to_route('task_statuses');
    }

    public function edit(int $id)
    {
        $status = TaskStatus::findOrFail($id);

        return view('statuses.edit', compact('status'));
    }

    public function update(UpdateTaskStatusRequest $request, int $id)
    {
        $status = TaskStatus::findOrFail($id);
        $validated = $request->validated();

        $status->update($validated);

        flash('Статус успешно изменён')->success();

        return to_route('task_statuses');
    }

    public function destroy(int $id)
    {
        $status = TaskStatus::findOrFail($id);

        if ($status->tasks()->exists()) {
            flash('Не удалось удалить статус')->warning();

            return back();
        }

        $status->delete();

        flash('Статус успешно удалён')->success();

        return to_route('task_statuses');
    }
}
