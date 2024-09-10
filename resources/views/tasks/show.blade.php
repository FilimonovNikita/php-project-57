@extends('layouts.app')

@section('content')
<div>
    <h2>
        Просмор задачи: {{$task->name}}
    </h2>
    <p>Имя: {{$task->name}}</p>
    <p>Статус: {{$task->taskStatus->name}}</p>
    <p>Описание: {{$task->description}}</p>
    <p>Метки: </p>
</div>
@endsection