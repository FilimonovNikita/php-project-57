@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">
            {{ __('task_status.create.header') }}
        </h1>

        <form action="{{ route('task_statuses.store') }}" method="POST" class="w-50">
            @csrf
            <div class="flex flex-col">
                <div>
                    <label for="name">{{ __('task_status.create.name') }}</label>
                </div>
                <div class="mt-2">
                    <input type="text" name="name" id="name" class="rounded border-gray-300 w-1/3" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="text-rose-600">{{ $message }}</div>
                @enderror
                <div class="mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded">
                        {{ __('task_status.create.button') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
        <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
@endSection
