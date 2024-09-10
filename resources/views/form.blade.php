@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles')
<style>
    .error-message {
        color: red;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div>
            <lable for="title">
                Title
            </lable>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"/>
            @error('title')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="description">
                Descritpion
            </label>
            <textarea name="description" id="description" rows="5">{{ $task->title ?? old('description') }}</textarea>
            @error('description')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">
                Long Descritpion
            </label>
            <textarea name="long_description" id="long_description" rows="10">{{ $task->title ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div>
            <button type="submit">@isset($task)
                Update task
                @endisset
                Add Task</button>
        </div>
    </form>
@endsection
