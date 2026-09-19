<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

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

    public function store(Request $request)
    {
        $request->merge([
            'created_by_id' => Auth::id(),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:24|unique:tasks,name',
            'description' => 'nullable|string|max:255',
            'status_id' => 'required|exists:task_statuses,id',
            'created_by_id' => 'required|exists:users,id',
            'assigned_to_id' => 'nullable|exists:users,id',
            'labels' => 'nullable|array'
        ]);

        $task = Task::create($validated);

        $task->labels()->sync($request->input('labels', []));

        flash('Задача успешно создана')->success();

        return redirect()->route('tasks');
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

    public function update(Request $request, int $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'name' => "required|string|max:24|unique:tasks,name,{$task->id}",
            'description' => 'nullable|string|max:255',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
            'labels' => 'nullable|array'
        ]);

        $task->update($validated);

        $task->labels()->sync($request->input('labels', []));

        flash('Задача успешно изменена')->success();

        return redirect()->route('tasks');
    }
    // FIXME: удаление задачи только создателем
    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        flash('Задача успешно удалена')->success();

        return redirect()->route('tasks');
    }
}
