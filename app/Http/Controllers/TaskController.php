<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = QueryBuilder::for(Task::class)
            ->defaultSort('id')
            ->allowedFilters(
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            )
            ->with('status', 'createdBy', 'assignedTo')
            ->get();

        $statuses = TaskStatus::orderBy('id')->pluck('name', 'id');
        $users = User::orderBy('id')->pluck('name', 'id');

        return view('tasks', compact('tasks', 'statuses', 'users'));
    }

    public function create()
    {
        $statuses = TaskStatus::orderBy('id')->pluck('name', 'id');
        $users = User::pluck('name', 'id')->prepend('', '');
        $labels = Label::orderBy('id')->pluck('name', 'id');

        return view('tasks.create', compact('statuses', 'users', 'labels'));
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $task = Task::create($validated);
        $task->labels()->sync($request->input('labels', []));

        flash('Задача успешно создана')->success();

        return to_route('tasks');
    }

    public function show(int $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    public function edit(int $id)
    {
        $task = Task::findOrFail($id);
        $statuses = TaskStatus::orderBy('id')->pluck('name', 'id');
        $users = User::pluck('name', 'id')->prepend('', '');
        $labels = Label::orderBy('id')->pluck('name', 'id');

        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = Task::findOrFail($id);
        $validated = $request->validated();
        $task->update($validated);
        $task->labels()->sync($request->input('labels', []));

        flash('Задача успешно изменена')->success();

        return to_route('tasks');
    }

    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);

        if (Gate::denies('delete', $task)) {
            flash('Не удалось удалить задачу')->warning();

            return back();
        }

        $task->delete();

        flash('Задача успешно удалена')->success();

        return to_route('tasks');
    }
}
