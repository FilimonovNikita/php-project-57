@extends('layouts.app')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5" style="font-size: 3rem;">{{ __('task_label.edit.header') }}</h1>
    <form class="w-50" method="POST" 
        action="{{route('task_labels.update', $taskLabel->id)}}">
        @csrf
        @method('PATCH')
        <div class="flex flex-col">
            <div>
                <label for="name">{{ __('task_label.edit.name') }}</label>
            </div>
            <div class="mt-2">
                <input class="rounded border-gray-300 w-1/3" 
                type="text" name="name" id="name"
                value="{{ old('name', $taskLabel->name) }}">
            </div>
            <div class="mt-2">
                <label for="description">{{ __('task_label.edit.description') }}</label>
            </div>
            <div class="mt-2">
                <textarea 
                    class="rounded border-gray-300 w-1/3 h-32" 
                    name="description" id="description"
                    value="{{ old('name', $taskLabel->description) }}">
                </textarea>
            </div>
            <div class="mt-2">
                <button 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
                    type="submit">
                    {{ __('task_label.edit.button') }}
                </button>
                <a href="{{ route('task_labels.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center">
                {{ __('task_label.edit.back') }}</a>
            </div>
        </div>
    </form>
</div>
@endSection