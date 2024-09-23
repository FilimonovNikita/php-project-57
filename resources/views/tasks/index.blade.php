@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('task.index.header') }}</h1>
        
        <div class="w-full flex items-center mb-4">
            <form method="GET" action="{{ route('tasks.index') }}" class="flex space-x-2">
                <select class="rounded border-gray-300" name="filter[status_id]" id="filter[status_id]">
                    <option value selected="selected">{{ __('task.index.status') }}</option>
                    @foreach($taskStatus as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <select class="rounded border-gray-300" name="filter[created_by_id]" id="filter[created_id]">
                    <option value selected="selected">{{ __('task.index.created_by') }}</option>
                    @foreach ($users as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <select class="rounded border-gray-300" name="filter[assigned_to_id]" id="filter[assigned_to_id]">
                    <option value selected="selected">{{ __('task.index.assigned_to') }}</option>
                    @foreach ($users as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit">
                    Применить
                </button>
            </form>
            @auth
            <div class="ml-auto">
                <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('task.index.create') }}      
                </a>
            </div>
            @endauth
        </div>

        <table>
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>{{ __('task.index.id') }}</th>
                    <th>{{ __('task.index.status') }}</th>
                    <th>{{ __('task.index.name') }}</th>
                    <th>{{ __('task.index.created_by') }}</th>
                    <th>{{ __('task.index.assigned_to') }}</th>
                    <th>{{ __('task.index.created_at') }}</th>
                    @auth
                    <th>{{ __('task.index.actions') }}</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <td>{{$task->id}}</td>
                    <td>{{$task->taskStatus->name}}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}">
                        {{$task->name}}
                        </a>
                    </td>
                    <td>{{$task->author->name}}</td>
                    <td>{{$task->assignedTo->name ?? ''}}</td>
                    <td>{{$task->formatted_date}}</td>
                    @auth
                        <td>
                            @can('delete', $task)
                            <form data-confirm="{{ __('tasks.index.delete_confirmation') }}"
                                action="{{ route('tasks.destroy', $task->id) }}" 
                                method="POST" 
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">{{ __('task.index.delete') }}</button>
                            </form>
                            @endcan
                            @can('update', $task)
                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-900">
                                {{ __('task.index.edit') }}
                            </a>
                            @endcan
                        </td>
                    @endauth
                </tr>    
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
@endSection
