@extends('layout')

@section('title')
    View your connection(s)!
@stop

@section('content')
    You have {{count($connections)}} connection(s)!</br> </br>

    @forelse($connections as $connection)
        <div>
            {{$user->name}} <br>
            {{$user->twitter}} <br>
            {{$user->email}} <br> <br>
        </div>

    @empty
        <div>
            Nobody has offered to connect with you yet. Reach out to new places and people!
        </div>
    @endforelse
@stop
