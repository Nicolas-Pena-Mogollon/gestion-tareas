<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tasks</div>
                <div class="card-body">
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>
                    <ul class="list-group">
                        @foreach($tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $task->title }}
                                <div class="btn-group" role="group">
                                    @if($task->completed)
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success ml-2">Mark as Completed</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary ml-2">Edit</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
