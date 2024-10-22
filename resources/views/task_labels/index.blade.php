@extends('layouts.app')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5" style="font-size: 3rem;">{{ __('task_label.index.header') }}</h1>
    @auth  
        <div>
            <a href="{{route('labels.create')}}" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('task_label.index.create') }}           
            </a>
        </div>
    @endauth
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>{{ __('task_label.index.id') }}</th>
                <th>{{ __('task_label.index.name') }}</th>
                <th>{{ __('task_label.index.description') }}</th>
                <th>{{ __('task_label.index.created_at') }}</th>
                @auth
                <th>{{ __('task_label.index.actions') }}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($taskLabels as $label)
            <tr class="border-b border-dashed text-left">
                <td>{{$label->id}}</td>
                <td>{{$label->name}}</td>
                <td>{{$label->description}}</td>
                <td>{{$label->formattedDate}}</td>
                @auth
                <td>
                <a href="#" class="text-red-500 hover:text-red-700 ml-2"
                    onclick="event.preventDefault();
                                if(confirm(`{{ __('task_label.index.delete_confirm') }}`)) {
                                    document.getElementById('delete-form-{{ $label->id }}').submit();
                                }">
                    {{ __('task_label.index.delete') }}
                    </a>
                
                    <form id="delete-form-{{ $label->id }}" action="{{ route('labels.destroy', $label->id) }}" method="POST" class="hidden"> 
                        @csrf 
                        @method('DELETE') 
                    </form> 
                    <a class="text-blue-600 hover:text-blue-900" href="{{route ('labels.edit', $label->id)}}">
                    {{ __('task_label.index.edit') }}</a>
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $taskLabels->links() }}
    </div>
</div>
@endSection
