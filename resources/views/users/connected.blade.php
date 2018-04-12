@extends('layout')

@section('title')
    You've sent a connection request!
@stop

@section('content')

    @if($connection->user_id == $connection->owner_id)
        You connected with yourself! Doesn't it feel good to know the real you?
    @else
        You connected with {{$user_name}}.<br>
    @endif
    You might hear from them soon! <br>
    Being social is all about visiting new places and meeting new folks! <br>
    Thanks for using limes!<br>
    <a href="/">Back to home page.</a>
@stop
