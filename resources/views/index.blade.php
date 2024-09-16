@extends('layouts.app')

@section('title')
<h1>The list of tasks</h1>
@endsection

{{-- Chech if something is not null or undefined --}}
{{-- @isset($name)
<div> The name is: {{ $name }}</div>
@endisset --}}
@section('content')
    <nav class="mb-4">
        <a class="link" href="{{ route('tasks.create') }}">Add task</a>
    </nav>
    <div>
        {{-- Another way to check if something is in an array  --}}
        {{-- @if (count($tasks)) --}}
            @forelse ($tasks as $task)
                <div>
                    <a @class(['line-through' => $task->completed]) href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title}}</a>
                </div>
            @empty
                <div>There are no tasks.. </div>
            @endforelse
        {{-- @endif --}}
            @if ($tasks->count())
                <nav class="mt-4 flex flex-col">
                    {{ $tasks->links() }}
                </nav>
            @endif
    </div>
@endsection
