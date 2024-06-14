@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tareas') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <select id="filterTasks" class="form-select">
                            <option value="{{ route('tasks.index') }}" {{ !request()->has('filter') ? 'selected' : '' }}>{{ __('Todas las tareas') }}</option>
                            <option value="{{ route('tasks.index', ['filter' => 'completed']) }}" {{ request()->input('filter') === 'completed' ? 'selected' : '' }}>{{ __('Tareas completadas') }}</option>
                            <option value="{{ route('tasks.index', ['filter' => 'not_completed']) }}" {{ request()->input('filter') === 'not_completed' ? 'selected' : '' }}>{{ __('Tareas no completadas') }}</option>
                        </select>
                    </div>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3 d-block d-md-inline">{{ __('Crear tarea') }}</a>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Título') }}</th>
                                    <th>{{ __('Descripción') }}</th>
                                    <th>{{ __('Estado') }}</th>
                                    <th>{{ __('Creado') }}</th>
                                    <th>{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $task->description }}">{{ \Illuminate\Support\Str::limit($task->description, 100) }}</td>
                                        <td>{{ ucfirst($task->status->name) }}</td>
                                        <td>{{ $task->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <div class="d-flex flex-column flex-md-row align-items-center">
                                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm mb-1 mb-md-0 me-md-1">{{ __('Editar') }}</a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-1 mb-md-0 me-md-1">{{ __('Eliminar') }}</button>
                                                </form>
                                                @if($task->status->name != 'Completada')
                                                    <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">{{ __('Completar') }}</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $tasks->appends(['filter' => request()->input('filter')])->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('filterTasks').onchange = function() {
        window.location.href = this.value;
    };

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
</script>
@endsection
