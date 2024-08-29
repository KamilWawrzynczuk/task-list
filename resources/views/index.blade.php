@extends('layouts.app')

@section('title', $task->title)

{{-- Chech if something is not null or undefined --}}
{{-- @isset($name)
<div> The name is: {{ $name }}</div>
@endisset --}}

@section('content')
    <div>
        {{-- Another way to check if something is in an array  --}}
        {{-- @if (count($tasks)) --}}
            @forelse ($tasks as $task)
                <div>
                    <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{ $task->title}}</a>
                </div>
            @empty
                <div>There are no tasks.. </div>
            @endforelse
        {{-- @endif --}}
    </div>
@endsection
