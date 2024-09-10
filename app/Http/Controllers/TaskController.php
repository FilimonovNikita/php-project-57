<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\AuthorizationException;

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

    public function index()
    {
        $tasks = Task::orderby("id")->paginate(15);
        $taskStatus = TaskStatus::orderby('id')->pluck('name', "id");
        $users = User::orderby('id')->pluck('name', "id");
        return view('tasks.index', compact("tasks", "taskStatus", "users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks =new Task();
        $taskStatus = TaskStatus::orderby('id')->pluck('name', "id");
        $users = User::orderby('id')->pluck('name', "id");
        return view('tasks.create', compact("tasks", "taskStatus", "users"));
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
        $task->created_by_id = (int) Auth::id();

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
        $taskStatus = TaskStatus::orderby('id')->pluck('name', "id");
        $users = User::orderby('id')->pluck('name', "id");
        return view('tasks.show', compact("task", "taskStatus", "users"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $taskStatus = TaskStatus::orderby('id')->pluck('name', "id");
        $users = User::orderby('id')->pluck('name', "id");
        return view('tasks.edit', compact("task", "taskStatus", "users"));//
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

        // Заполняем модель данными и сохраняем
        $task->fill($data);
        $task->save();

        // Перенаправляем с успешным сообщением
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Задача успешно обновлена');
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
