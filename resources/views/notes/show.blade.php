

@extends('layout')

@section('title', 'notes')


@section('content')

  <h1>{{ $note['title'] }}</h1>
<p>{{ $note['body'] }}</p>

<a href="{{ route('notes.index') }}">Back</a>

@endsection