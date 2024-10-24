@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5" style="font-size: 3rem;">{{ __('task.index.header') }}</h1>
        
        <div class="w-full flex items-center mb-4">
        {{ html()->form('GET', route('tasks.index'))->class('flex space-x-2')->open() }}

        {{ html()->select('filter[status_id]', ['' => __('task.index.status')] + $taskStatus->toArray(), $filter['status_id'] ?? null)
            ->class('rounded border-gray-300') }}

        {{ html()->select('filter[created_by_id]', ['' => __('task.index.created_by')] + $users->toArray(), $filter['created_by_id'] ?? null)
            ->class('rounded border-gray-300') }}

        {{ html()->select('filter[assigned_to_id]', ['' => __('task.index.assigned_to')] + $users->toArray(), $filter['assigned_to_id'] ?? null)
            ->class('rounded border-gray-300') }}

        {{ html()->button('Применить')
            ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2')
            ->type('submit') }}

        {{ html()->form()->close() }}

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
                            <a href="#" class="text-red-500 hover:text-red-700 ml-2"
                                onclick="event.preventDefault();
                                if(confirm(`{{ __('task.index.delete_confirm') }}`)) {
                                    document.getElementById('delete-form-{{ $task->id }}').submit();
                                }">
                                {{ __('task.index.delete') }}
                                </a>
                            
                                <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="hidden"> 
                                    @csrf 
                                    @method('DELETE') 
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
