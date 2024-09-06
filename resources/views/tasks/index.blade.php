@extends('layouts.app')

@section('content')
    <h1>Задача</h1>
    <div>
        <div>
            <form>
                <div>
                    <select class="rounded border-gray-300" name="filter[status_id]" id="filter[status_id]">
                        <option value selected="selected">Статус</option>
                            @foreach ($task_status as $status)
                            <option value ="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                    </select>
                    <select class="rounded border-gray-300" name="filter[created_id]" id="filter[created_id]">
                        <option value selected="selected">Автор</option>
                            @foreach ($users as $user)
                            <option value ="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                    </select>
                    <select class="rounded border-gray-300" name="filter[assigned_to_id]" id="filter[assigned_to_id]">
                        <option value selected="selected">Исполнитель</option>
                            @foreach ($users as $user)
                            <option value ="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                    </select>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit">
                        Применить
                    </button>
                </div>
                @auth
                <div>
                    <a href="{{route('tasks')}}">
                        Создать задачу       
                    </a>
                </div>
                @endauth
            </form>
        </div>
        <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    </div>
@endSection
