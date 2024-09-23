@extends('layouts.app')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5 text-black dark:text-white text-5xl">{{ __('task.edit.header') }}</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="post">
        @csrf
        @method('PATCH') <!-- Используйте PATCH метод для обновления записи -->
        <div class="flex flex-col">
            <label for="name" class="text-black dark:text-white">{{ __('task.edit.name') }}</label>
            <input type="text" id="name" name="name" class="rounded border-gray-300 w-1/3" value="{{ old('name', $task->name) }}">
            @if ($errors->first('name'))
                <div class="text-red-500">{{ $errors->first('name') }}</div>
            @endif
            <label for="description" class="text-black dark:text-white">{{ __('task.edit.description') }}</label>
            <textarea id="description" name="description" class="rounded border-gray-300 w-1/3 h-32">{{ old('description', $task->description) }}</textarea>
            @if ($errors->first('description'))
                <div class="text-red-500">{{ $errors->first('description') }}</div>
            @endif
            <label for="status_id" class="text-black dark:text-white">{{ __('task.edit.status') }}</label>
            <select id="status_id" name="status_id" class="form-control rounded border-gray-300 w-1/3">
                @foreach($taskStatus as $id => $name)
                    <option value="{{ $id }}" {{ old('status_id', $task->status_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('status_id'))
                <div class="text-red-500">{{ $errors->first('status_id') }}</div>
            @endif
            <label for="assigned_to_id" class="text-black dark:text-white">{{ __('task.edit.assigned_to') }}</label>
            <select id="assigned_to_id" name="assigned_to_id" class="form-control rounded border-gray-300 w-1/3">
                @foreach($users as $id => $name)
                    <option value="{{ $id }}" {{ old('assigned_to_id', $task->assigned_to_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            <label for="labels" class="text-black dark:text-white">{{ __('task.edit.labels') }}</label>
            <select id="labels" name="labels[]" multiple class="form-control rounded border-gray-300 w-1/3">
                @foreach($taskLabels as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <div class="flex space-x-4">
                <input type="submit" value="{{ __('task.edit.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block" />
                <a href="{{ route('tasks.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center">{{ __('task.edit.back') }}</a>
            </div>
        </div>
    </form>
</div>
@endsection