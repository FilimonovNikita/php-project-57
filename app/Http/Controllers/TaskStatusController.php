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
        $taskStatus =new TaskStatus();
        return view('task_status.create', compact("taskStatus"));
    }
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255|unique:task_statuses'
            ],
            [
                'name.unique' => __('task_statuses.validation.unique')
            ]);
        $taskStatus  = new TaskStatus();

        $taskStatus ->fill($data);

        $taskStatus ->save();

        return redirect()
        ->route('task_statuses.index')
        ->with('success', 'Статус задачи успешно создан');
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
            'name.unique' => __('task_statuses.validation.unique')
        ]);

        $taskStatus ->fill($data);

        $taskStatus ->save();

        return redirect()
        ->route('task_statuses.index')
        ->with('success', 'Статус задачи успешно создан');
        }
    public function destroy(TaskStatus $taskStatus)
    {
        Log::info('Метод destroy вызван');
        $taskStatus->delete();
        return redirect()->
            route('task_statuses.index')->
            with('sucsess', "Статус задачи успешно удалён");
    }
}
