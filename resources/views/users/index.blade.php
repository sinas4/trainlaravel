
@extends('layout')

@section('content')

  <h1>user list</h1>
    <?php $number = 2  ?>

    @if ($number=== 1)
        {{ 'number1' }}

    @elseif ($number == 2)
        {{ 'number2' }}    
    @else 
    {{ 'uknown number ' }}    
    @endif
    
    <ul>
        <li><a href="{{ route("users.single" , ['userId' => 'user-number1' ]) }}">user1</a></li>
        <li><a href="{{ route("users.single" , ['userId' => 'user-number2' ]) }}">user2</a></li>
        <li><a href="{{ route("users.single" , ['userId' => 'user-number3' ]) }}">user3</a></li>
    </ul>

@endsection