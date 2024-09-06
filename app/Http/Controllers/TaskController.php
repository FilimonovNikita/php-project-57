<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('guest');
        //$this->authorizeResource(Task::class);
    }

    public function index()
    {
        $tasks = Task::orderby("id")->paginate(15);
        return view('tasks.index', compact("tasks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks =new Task();
        return view('tasks.create', compact("tasks"));
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
                'label' => 'nullable|array',
            ],
            [
                'name.unique' => __('task_statuses.validation.unique')
            ]);
        $task  = new Task();

        $task ->fill($data);

        $task ->save();

        return redirect()
        ->route('tasks.index')
        ->with('success', 'Задача успешно создана');//
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.create', compact("task"));//
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:tasks',
                'status_id' => 'required|exists:task_statuses,id',
                'description' => 'nullable|string',
                'assigned_to_id' => 'nullable|integer',
                'label' => 'nullable|array',
            ],
            [
                'name.unique' => __('task_statuses.validation.unique')
            ]);
        $task  = new Task();

        $task ->fill($data);

        $task ->save();

        return redirect()
        ->route('tasks.index')
        ->with('success', 'Задача успешно создана');//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->
            route('tasks.index')->
            with('sucsess', "Задача успешно удалена");
    }
}
