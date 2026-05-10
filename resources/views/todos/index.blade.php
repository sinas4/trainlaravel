
@extends('layout')

@section('title', 'todo')


@section('content')

  
<h1>Todo List</h1>

<form action="{{ route('todos.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="New Todo">
    <button type="submit">Add</button>
</form>

<ul>
    @foreach($todos as $index => $todo)
        <li>
            {{ $todo }}
            <a href="{{ route('todos.delete', $index) }}">❌</a>
        </li>
    @endforeach
</ul>


@endsection