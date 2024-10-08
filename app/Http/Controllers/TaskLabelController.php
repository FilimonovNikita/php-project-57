<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskLabel;
use Illuminate\Support\Facades\Log;

class TaskLabelController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest');
        $this->authorizeResource(TaskLabel::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskLabels = TaskLabel::orderby('id')->paginate(15);
        return view("task_labels.index", compact("taskLabels"));//
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskLabel = new TaskLabel();
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
                'name' => 'required|unique:task_labels',
                'description' => 'nullable|string',
            ],
            [
                'name.unique' => __('task_statuses.validation.unique')
            ]
        );
        $taskLabel = new TaskLabel();

        $taskLabel->fill($data);

        $taskLabel->save();
        flash(__('task_label.flash.store'))->success();

        return redirect()
            ->route('task_labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskLabel $taskLabel)
    {
        return view("task_labels.edit", compact("taskLabel"));////
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskLabel $taskLabel)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:task_labels,name,' . $taskLabel->id,
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
            ->route('task_labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskLabel $taskLabel)
    {
        Log::info('Метод destroy вызван');
        if ($taskLabel->task->count() > 0) {
            flash(__('flashes.task_label.error'))->error();
            return back();
        }
        $taskLabel->delete();
        flash(__('task_label.flash.delete'))->success();

        return redirect()->
            route("task_labels.index");
        //
    }
}
