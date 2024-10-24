<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::orderBy('id')->paginate();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('label.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:labels',
                'description' => 'nullable|string',
            ],
            [
                'name.required' => __('task_label.validation.required'),
                'name.unique' => __('task_label.validation.unique')
            ]
        );
        $label = new Label();

        $label->fill($data);

        $label->save();
        flash(__('task_label.flash.store'))->success();

        return redirect()
            ->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:labels,name,' . $label->id,
                'description' => 'nullable|string',
            ],
            [
                'name.required' => __('task_label.validation.required'),
                'name.unique' => __('task_label.validation.unique')
            ]
        );

        $label->fill($data);

        $label->save();
        flash(__('task_label.flash.update'))->success();

        return redirect()
            ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if ($label->task()->exists()) {
            flash(__('task_label.flash.delete_error'))->error();
            return back();
        }

        $label->delete();
        flash(__('task_label.flash.delete'))->success();

        return redirect()->route('labels.index');
    }
}
