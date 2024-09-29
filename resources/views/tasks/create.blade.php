@extends('layouts.app')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5 text-black dark:text-white text-5xl" style="font-size: 3rem;">{{ __('task.create.header') }}</h1>
    <form class="w-50" action="{{ route('tasks.store') }}" method="post">
        @csrf
        <div class="flex flex-col">
            <label for="name" class="text-black dark:text-white">{{ __('task.create.name') }}</label>
            <input class="rounded border-gray-300 w-1/3" type="text" id="name" name="name" class="mt-2">
            @if ($errors->first('name'))
                <div class="text-red-500">{{ $errors->first('name') }}</div>
            @endif
            <label for="description" class="text-black dark:text-white">{{ __('task.create.description') }}</label>
            <textarea class="rounded border-gray-300 w-1/3 h-32" id="description" name="description" class="mt-2"></textarea>
            @if ($errors->first('description'))
                <div class="text-red-500">{{ $errors->first('description') }}</div>
            @endif
            <label for="status_id" class="text-black dark:text-white">{{ __('task.create.status') }}</label>
            <select id="status_id" name="status_id" class="form-control rounded border-gray-300 w-1/3" placeholder="----------">
                @foreach($taskStatus as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @if ($errors->first('status_id'))
                <div class="text-red-500">{{ $errors->first('status_id') }}</div>
            @endif
            <label for="assigned_to_id" class="text-black dark:text-white">{{ __('task.create.assigned_to') }}</label>
            <select id="assigned_to_id" name="assigned_to_id" class="form-control rounded border-gray-300 w-1/3" placeholder="----------">
                @foreach($users as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <label for="labels" class="text-black dark:text-white">{{ __('task.create.labels') }}</label>
            <select id="labels" name="labels[]" multiple class="form-control rounded border-gray-300 w-1/3">
                @foreach($taskLabels as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <div class="flex space-x-4">
                <input type="submit" value="{{ __('task.create.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block" />
                <a href="{{ route('tasks.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center">{{ __('task.create.back') }}</a>
            </div>
        </div>
    </form>
</div>
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
@endsection