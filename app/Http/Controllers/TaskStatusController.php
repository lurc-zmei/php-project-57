<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatus = TaskStatus::all();
        return view('task_statuses', compact('taskStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:24|unique:task_statuses,name'
        ]);

        TaskStatus::create($validated);

        flash('Статус успешно создан')->success();

        return redirect()->route('task_statuses');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $status = TaskStatus::findOrFail($id);
        return view('statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $status = TaskStatus::findOrFail($id);
        $data = $request->validate([
            'name' => "required|unique:task_statuses,name,{$status->id}"
        ]);

        $status->update($data);

        return redirect()->route('task_statuses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $status = TaskStatus::findOrFail($id);
        $status->delete();

        return redirect()->route('task_statuses');
    }
}
