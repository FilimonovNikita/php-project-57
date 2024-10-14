<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;
use Illuminate\Support\Facades\Log;

class LabelController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest');
        $this->authorizeResource(Label::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskLabels = Label::orderby('id')->paginate(15);
        return view("task_labels.index", compact("taskLabels"));//
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskLabel = new Label();
        return view("task_labels.create", compact("taskLabel"));//
        //
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
                'name.unique' => __('task_statuses.validation.unique')
            ]
        );
        $taskLabel = new Label();

        $taskLabel->fill($data);

        $taskLabel->save();
        flash(__('task_label.flash.store'))->success();

        return redirect()
            ->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $taskLabel)
    {
        return view("task_labels.edit", compact("taskLabel"));////
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $taskLabel)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:labels,name,' . $taskLabel->id,
                'description' => 'nullable|string',
            ],
            [
                'name.unique' => __('task_statuses.validation.unique')
            ]
        );

        $taskLabel->fill($data);

        $taskLabel->save();
        flash(__('task_label.flash.update'))->success();

        return redirect()
            ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        Log::info('Метод destroy вызван');
        if ($label->task->count() > 0) {
            flash(__('flashes.task_label.error'))->error();
            return back();
        }
        $label->delete();
        flash(__('task_label.flash.delete'))->success();

        return redirect()->
            route("labels.index");
        //
    }
}
