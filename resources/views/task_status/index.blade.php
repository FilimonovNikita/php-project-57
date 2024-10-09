@extends('layouts.app')

@section('content')
        <div class="grid col-span-full">
            <h1 class="mb-5" style="font-size: 3rem;">{{ __('task_status.index.header') }}</h1>
        @auth
            <div>
                <a href="{{route('task_statuses.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('task_status.index.create') }}
                </a>
            </div>
        @endauth
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>{{ __('task_status.index.id') }}</th>
                    <th>{{ __('task_status.index.name') }}</th>
                    <th>{{ __('task_status.index.created_at') }}</th>
                    @auth
                    <th>{{ __('task_status.index.actions') }}</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($taskStatus as $status)
                    <tr class="border-b border-dashed text-left">
                        <td>
                            {{$status->id}}
                        </td>
                        <td>
                            {{$status->name}}
                        </td>
                        <td>
                            {{$status->created_at}}
                        </td>
                        @auth
                            <td>
                            @can('delete', $status)
                            <form data-confirm="{{ __('task_status.index.delete_confirm') }}"
                                action="{{ route('task_statuses.destroy', $status->id) }}"
                                method="POST" 
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                onclick="return confirm('{{ __(task_status.index.delete_confirm) }}')"
                                >{{ __('task_status.index.delete') }}</button>
                            </form>
                            @endcan
                                <a href="{{ route('task_statuses.edit', $status->id) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ __('task_status.index.edit') }}
                                </a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="mt-4">
            {{ $taskStatus->links() }}
        </div>
        <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    </div>
@endSection
