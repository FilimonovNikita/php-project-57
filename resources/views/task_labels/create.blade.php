@extends('layouts.app')

@section('content')
    
<div class="grid col-span-full">
    <h1 class="mb-5" style="font-size: 3rem;">{{ __('task_label.create.header') }}</h1>
    <form class="w-50" method="POST" 
        action="{{route('labels.store')}}">
        @csrf
        <div class="flex flex-col">
            <div>
                <label for="name">{{ __('task_label.create.name') }}</label>
            </div>
            <div class="mt-2">
                <input class="rounded border-gray-300 w-1/3" 
                type="text" name="name" id="name">
            </div>
            @error('name')
                    <div class="text-rose-600">{{ $message }}</div>
            @enderror
            <div class="mt-2">
                <label for="description">{{ __('task_label.create.description') }}</label>
            </div>
            <div class="mt-2">
                <textarea 
                    class="rounded border-gray-300 w-1/3 h-32" 
                    name="description" id="description">
                </textarea>
            </div>
            <div class="mt-2">
                <button 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
                    type="submit">
                    {{ __('task_label.create.button') }}
                </button>
                <a href="{{ route('labels.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center">
                    {{ __('task_label.create.back') }}</a>
            </div>
        </div>
    </form>
</div>
@endSection