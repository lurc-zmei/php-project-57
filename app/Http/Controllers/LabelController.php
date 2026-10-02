<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::orderBy('id')->get();

        return view('labels', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store(StoreLabelRequest $request)
    {
        $validated = $request->validated();

        Label::create($validated);

        flash('Метка успешно создана')->success();

        return to_route('labels');
    }

    public function edit(int $id)
    {
        $label = Label::findOrFail($id);

        return view('labels.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, int $id)
    {
        $label = Label::findOrFail($id);

        $validated = $request->validated();
        $label->update($validated);

        flash('Метка успешно изменена')->success();

        return to_route('labels');
    }

    public function destroy(int $id)
    {
        $label = Label::findOrFail($id);

        if ($label->tasks()->exists()) {
            flash('Не удалось удалить метку')->warning();

            return back();
        }

        $label->delete();

        flash('Метка успешно удалена')->success();

        return to_route('labels');
    }
}
