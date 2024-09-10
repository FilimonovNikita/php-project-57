@extends('layouts.app')

@section('content')
    <h1>Задача</h1>
    <div>
        <div>
            <form>
                <div>
                    <select class="rounded border-gray-300" name="filter[status_id]" id="filter[status_id]">
                        <option value selected="selected">Статус</option>
                        @foreach($taskStatus as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <select class="rounded border-gray-300" name="filter[created_id]" id="filter[created_id]">
                        <option value selected="selected">Автор</option>
                            @foreach ($users as $id => $name)
                            <option value ="{{$id}}">{{$name}}</option>
                            @endforeach
                    </select>
                    <select class="rounded border-gray-300" name="filter[assigned_to_id]" id="filter[assigned_to_id]">
                        <option value selected="selected">Исполнитель</option>
                            @foreach ($users as $id => $name)
                            <option value ="{{$id}}">{{$name}}</option>
                            @endforeach
                    </select>
                    <button class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded ml-2" type="submit">
                        Применить
                    </button>
                </div>
                @auth
                <div>
                    <a href="{{route('tasks.create')}}">
                        Создать задачу       
                    </a>
                </div>
                @endauth
                <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Статус</th>
                        <th>Имя</th>
                        <th>Автор</th>
                        <th>Исполнитель</th>
                        <th>Дата создания</th>
                        @auth
                        <th>Действия</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
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
                                    action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Удалить</button>
                                </form>
                                
                                <button class="btn btn-danger" 
                                    data-remote="true" 
                                    data-method="delete" 
                                    data-url="{{ route('tasks.destroy', $task->id) }}">
                                    {{ __('tasks.index.delete') }}
                                </button>
                                <a data-confirm="Вы уверены?" 
                                    data-method="delete" 
                                    href="{{ route('tasks.destroy', $task->id) }}" 
                                    class="text-red-600 hover:text-red-900">
                                    Удалить</a>
                                @endcan
                                @can('update', $task)
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ __('tasks.index.edit') }}
                                </a>
                                @endcan
                            </td>
                        @endauth
                    </tr>    
                    @endforeach
                </tbody>
            </form>
        </div>
        <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    </div>
@endSection
