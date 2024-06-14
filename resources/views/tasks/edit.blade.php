@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($task) ? 'Editar Tarea' : 'Crear Tarea' }}</div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}">
                        @csrf
                        @if(isset($task))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Título') }}</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $task->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Descripción') }}</label>
                            <textarea name="description" id="description"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status_id" class="form-label">{{ __('Estado') }}</label>
                            <select name="status_id" id="status_id" class="form-control">
                                @foreach($taskstatus as $status)
                                    <option value="{{ $status->id }}" @if($status->id === $task->status_id) selected @endif>
                                        {{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">{{ isset($task) ? __('Actualizar') : __('Crear') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
