@extends('layouts.app')

@section('content')
        <div class="grid col-span-full">
            <h1 class="mb-5">Статусы</h1>
        </div>
        @auth
            <div>
                <a href="{{route('task_statuses.create')}}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                    Создать статус
                </a>
            </div>
        @endauth
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                    @auth
                    <th>Действия</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($taskStatus as $status)
                    <tr>
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
                                <a href="{{ route('task_statuses.destroy', $status->id) }}"
                                data-confirm="{{ __('task_status.index.delete_confirm') }}"
                                class="text-red-600 hover:text-red-900"
                                onclick="event.preventDefault(); if(confirm(this.getAttribute('data-confirm'))) { document.getElementById('delete-form-{{ $status->id }}').submit(); }">
                                {{ __('task_status.index.delete') }}
                                </a>

                                <form action="{{ route('task_statuses.destroy', $status->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Удалить</button>
                                </form>

                                <a href="{{ route('task_statuses.edit', $status->id) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ __('task_status.index.edit') }}
                                </a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    </div>
@endSection
