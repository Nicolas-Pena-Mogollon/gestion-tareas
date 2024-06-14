@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear Tarea') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="title">{{ __('Título') }}</label>
                            <input type="text" name="title" class="form-control" id="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="description">{{ __('Descripción') }}</label>
                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status_id">{{ __('Estado') }}</label>
                            <select name="status_id" id="status_id" class="form-control">
                                @foreach($taskstatus as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">{{ __('Guardar Tarea') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
