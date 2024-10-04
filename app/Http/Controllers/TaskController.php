<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\TaskLabel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\AuthorizationException;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        //$this->middleware('guest');
        $this->authorizeResource(Task::class);
    }

    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $tasks = QueryBuilder::for(Task::class)
        ->allowedFilters([
            AllowedFilter::exact('status_id'),
            AllowedFilter::exact('assigned_to_id'),
            AllowedFilter::exact('created_by_id')
            ])
        ->orderBy('id')
        ->paginate(15);
        //$tasks = Task::orderby("id")->paginate(15);
        $taskStatus = TaskStatus::orderby('id')->pluck('name', "id");
        $users = User::orderby('id')->pluck('name', "id");
        return view('tasks.index', compact("tasks", "taskStatus", "users", "filter"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks = new Task();
        $taskStatus = TaskStatus::orderby('id')->pluck('name', "id");
        $users = User::orderby('id')->pluck('name', "id");
        $taskLabels = TaskLabel::orderby('id')->pluck('name', "id");
        return view('tasks.create', compact("tasks", "taskStatus", "users", 'taskLabels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:tasks',
                'status_id' => 'required|exists:task_statuses,id',
                'description' => 'nullable|string',
                'assigned_to_id' => 'nullable|integer',
            ],
            [
                'name.unique' => __('task.validation.unique')
            ]
        );

        $task = Auth::user()->createdTasks()->create($data);
        $task->save();

        $labels = $request->input('labels');

        if ($labels) {
            $task->tasklabel()->attach($labels);
        }

        flash(__('task.flash.store'))->success();

        return redirect()->route('tasks.index');//
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $taskStatus = TaskStatus::orderby('id')->pluck('name', "id");
        $users = User::orderby('id')->pluck('name', "id");
        $taskLabels = TaskLabel::orderby('id')->pluck('name', "id");
        return view('tasks.show', compact("task", "taskStatus", "users", 'taskLabels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $taskStatus = TaskStatus::orderby('id')->pluck('name', "id");
        $users = User::orderby('id')->pluck('name', "id");
        $taskLabels = TaskLabel::orderby('id')->pluck('name', "id");
        return view('tasks.edit', compact("task", "taskStatus", "users", "taskLabels"));//
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|unique:tasks,name,' . $task->id,
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer',
            'status_id' => 'required|integer',
            'label' => 'nullable|array',
        ], [
            'name.unique' => __('task_statuses.validation.unique')
        ]);

        $task = Auth::user()->createdTasks()->create($data);
        $task->save();

        $labels = $request->input('labels');

        if ($labels) {
            $task->tasklabel()->attach($labels);
        }

        flash(__('task.flash.update'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        flash(__('task.flash.delete'))->success();

        $task->delete();
        return redirect()->
            route('tasks.index');
    }
}
