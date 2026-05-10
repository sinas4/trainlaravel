

@extends('layout')

@section('title', 'notes')


@section('content')

  <h1>Notes</h1>

<form method="POST" action="{{ route('notes.store') }}">
    @csrf
    <input name="title" placeholder="Title">
    <input name="body" placeholder="Body">
    <button class="back-btn ">Add</button>
</form>

<hr>

@foreach($notes as $note)
    <div>
        <a href="{{ route('notes.show', $note['id']) }}">
            {{ $note['title'] }}
        </a>

        <a href="{{ route('notes.delete', $note['id']) }}">❌</a>
    </div>
@endforeach

@endsection