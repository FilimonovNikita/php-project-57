@extends('layouts.app')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h1 class="mb-5 text-black dark:text-white text-5xl">{{ __('layout.task.create') }}</h1>
                <form action="{{ route('tasks.store') }}" method="post">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="text-black dark:text-white">Name</label>
                        <input type="text" id="name" name="name" class="mt-2">
                        @if ($errors->first('name'))
                            <div class="text-red-500">{{ $errors->first('name') }}</div>
                        @endif
                        <label for="description" class="text-black dark:text-white">Description</label>
                        <textarea id="description" name="description" class="mt-2"></textarea>
                        @if ($errors->first('description'))
                            <div class="text-red-500">{{ $errors->first('description') }}</div>
                        @endif
                        <label for="status_id" class="text-black dark:text-white">Status</label>
                        <select id="status_id" name="status_id" class="form-control rounded border-gray-300 w-1/3" placeholder="----------">
                            @foreach($taskStatus as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->first('status_id'))
                            <div class="text-red-500">{{ $errors->first('status_id') }}</div>
                        @endif
                        <label for="assigned_to_id" class="text-black dark:text-white">Assigned To</label>
                        <select id="assigned_to_id" name="assigned_to_id" class="form-control rounded border-gray-300 w-1/3" placeholder="----------">
                            @foreach($users as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        {{-- 
                        <label for="labels" class="text-black dark:text-white">Labels</label>
                        <select id="labels" name="labels[]" multiple class="form-control rounded border-gray-300 w-1/3">
                            @foreach($labels as $label)
                                <option value="{{ $label->id }}">{{ $label->name }}</option>
                            @endforeach
                        </select>
                        --}}
                        <div class="mt-2">
                            <input type="submit" value="Create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" />
                            <a href="{{ route('tasks.index') }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
@endsection