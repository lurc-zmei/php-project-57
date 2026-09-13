<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:24|unique:labels,name',
            'description' => 'nullable|string|max:255'
        ]);

        Label::create($validated);

        flash('Метка успешно создана')->success();

        return redirect()->route('labels');
    }

    public function edit(int $id)
    {
        $label = Label::findOrFail($id);

        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, int $id)
    {
        $label = Label::findOrFail($id);

        $validated = $request->validate([
            'name' => "required|string|max:24|unique:labels,name,{$label->id}",
            'description' => 'nullable|string|max:255'
        ]);

        $label->update($validated);

        return redirect()->route('labels');
    }
}
