<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:24|unique:task_statuses,name'
        ]);

        TaskStatus::create($validated);

        flash('Статус успешно создан')->success();

        return redirect()->route('task_statuses');
    }

    public function show(TaskStatus $taskStatus)
    {
        //
    }

    public function edit(int $id)
    {
        $status = TaskStatus::findOrFail($id);

        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, int $id)
    {
        $status = TaskStatus::findOrFail($id);
        $validated = $request->validate([
            'name' => "required|unique:task_statuses,name,{$status->id}"
        ]);

        $status->update($validated);

        flash('Статус успешно изменен')->success();

        return redirect()->route('task_statuses');
    }

    public function destroy(int $id)
    {
        $status = TaskStatus::findOrFail($id);

        if ($status->tasks()->exists()) {
            flash('Не удалось удалить статус')->warning();

            return back();
        }

        $status->delete();

        flash('Статус успешно удален')->success();

        return redirect()->route('task_statuses');
    }
}
