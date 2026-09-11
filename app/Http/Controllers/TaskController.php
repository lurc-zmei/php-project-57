<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id')->prepend('');
        return view('tasks.create', compact('statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $task = Task::findOrFail($id);
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('tasks.edit', compact('task', 'statuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $task = Task::findOrFail($id);

        $request->merge([
            'created_by_id' => Auth::id(),
        ]);

        $validated = $request->validate([
            'name' => "required|string|max:24|unique:tasks,name,{$task->id}",
            'description' => 'nullable|string|max:255',
            'status_id' => 'required|exists:task_statuses,id',
            'created_by_id' => 'required|exists:users,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);

        flash('Задача успешно изменена')->success();

        return redirect()->route('tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
       $task = Task::findOrFail($id);
       $task->delete();

       return redirect()->route('tasks');
    }
}
