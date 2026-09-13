<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id')->get();

        return view('tasks', compact('tasks'));
    }

    public function create()
    {
        $statuses = TaskStatus::orderBy('id')->pluck('name', 'id');
        $users = User::pluck('name', 'id')->prepend('', '');

        return view('tasks.create', compact('statuses', 'users'));
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
        ]);

        Task::create($validated);

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

        return view('tasks.edit', compact('task', 'statuses', 'users'));
    }

    public function update(Request $request, int $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'name' => "required|string|max:24|unique:tasks,name,{$task->id}",
            'description' => 'nullable|string|max:255',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);

        flash('Задача успешно изменена')->success();

        return redirect()->route('tasks');
    }
    // FIXME: удаление задачи только создателем
    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks');
    }
}
