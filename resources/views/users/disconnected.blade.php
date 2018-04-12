@extends('layout')

@section('title')
    You've sent a connection request!
@stop

@section('content')
    You disconnected with {{$user_name}}.<br>
    That's sad, but we understand!<br>
    They will no longer see your contact info on their page, but heads up: if they looked already, they might still have it.<br>
    Thanks for using limes!<br>
    <a href="/">Back to home page.</a>
@stop
