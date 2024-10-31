<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Log;

class TaskStatusController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('guest');
        $this->authorizeResource(TaskStatus::class);
    }

    public function index()
    {
        Log::info('Метод index вызван');
        $taskStatus = TaskStatus::orderby("id")->paginate();
        return view('task_status.index', compact("taskStatus"));
    }

    public function create()
    {
        Log::info('Метод create вызван');
        $taskStatus = new TaskStatus();
        return view('task_status.create', compact("taskStatus"));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255|unique:task_statuses',
                'description' => 'nullable'
            ],
            [
                'name.unique' => __('task_status.validation.unique')
            ]
        );
        $taskStatus  = new TaskStatus();

        $taskStatus ->fill($data);

        $taskStatus ->save();

        flash(__('task_status.flash.store'))->success();

        return redirect()
        ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        Log::info('Метод edit вызван');
        return view('task_status.edit', compact("taskStatus"));
    }
    public function update(Request $request, TaskStatus $taskStatus)
    {
        Log::info('Метод update вызван');
        $data = $request->validate(
            [
                'name' => 'required|max:255|unique:task_statuses,name,' . $taskStatus->id
            ],
            [
            'name.unique' => __('task_status.validation.unique')
            ]
        );

        $taskStatus ->fill($data);

        $taskStatus ->save();

        flash(__('task_status.flash.update'))->success();

        return redirect()
        ->route('task_statuses.index');
    }
    public function destroy(TaskStatus $taskStatus)
    {
        Log::info('Метод destroy вызван');
        if ($taskStatus->tasks->count() > 0) {
            flash(__('task_status.flash.delete_error'))->error();
            return back();
        }
        $taskStatus->delete();

        flash(__('task_status.flash.delete'))->success();
        return redirect()->
            route('task_statuses.index');
    }
}
