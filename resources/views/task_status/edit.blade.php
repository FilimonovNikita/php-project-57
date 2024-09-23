@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">
            {{ __('task_status.edit.header') }}
        </h1>

        <form action="{{ route('task_statuses.update', $taskStatus) }}" method="POST" class="w-50">
            @csrf
            @method('PATCH')
            <div class="flex flex-col">
                <div>
                    <label for="name">{{ __('task_status.edit.name') }}</label>
                </div>
                <div class="mt-2">
                    <input type="text" name="name" id="name" class="rounded border-gray-300 w-1/3" value="{{ old('name', $taskStatus->name) }}">
                </div>
                @error('name')
                    <div class="text-rose-600">{{ $message }}</div>
                @enderror
                <div class="mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('task_status.edit.button') }}
                    </button>
                    <a href="{{ route('task_statuses.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center">{{ __('task_status.edit.back') }}</a>
                </div>
            </div>
        </form>
    </div>
@endsection