@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles')

@endsection

@section('content')
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <lable for="title">
                Title
            </lable>
            <input @class(['border-red-500' => $errors->has('title')]) type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"/>
            @error('title')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">
                Descritpion
            </label>
            <textarea  @class(['border-red-500' => $errors->has('description')]) name="description" id="description" rows="5">{{ $task->title ?? old('description') }}</textarea>
            @error('description')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">
                Long Descritpion
            </label>
            <textarea  @class(['border-red-500' => $errors->has('long_description')]) name="long_description" id="long_description" rows="10">{{ $task->title ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="flex gap-2 items-center">
            <button class="btn" type="submit">@isset($task)
                Update task
                @endisset
                Add Task</button>
            <a href="{{ route('tasks.index') }}" class="link">Cancel</a>
        </div>
    </form>
@endsection
