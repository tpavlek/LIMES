@extends('layout')

@section('title')
    View your connection(s)!
@stop

@section('content')
    Showing {{$user->name}}'s connections:<br> <br>
    You have {{$incoming->count()}} connection(s)!</br> </br>
    @forelse($incoming as $incoming_user)
        <div class="border border-dark rounded">
            {{$incoming_user->name}}<br>
            {{$incoming_user->twitter}}<br>
            {{$incoming_user->email}}<br>
            {{$incoming_user->facebook}}<br>
        </div>
    @empty
        <div>
            Nobody has offered to connect with you yet. Reach out to new places and people!
        </div>
    @endforelse <br>

    You're offering {{$outgoing->count()}} connection(s)! <br><br>
    @forelse($outgoing as $outgoing_user)
        <div class="border border-dark rounded">
            {{$outgoing_user->name}}<br>
            {{$outgoing_user->twitter}}<br>
            {{$outgoing_user->email}}<br>
            {{$outgoing_user->facebook}}<br>

            <form action="{{route('remove_connection', ['id' => $outgoing_user->id])}}" method="post">
                {{csrf_field()}}
                {{ method_field('delete') }}
                <button type="submit" class="btn p-2 bg-blue-light shadow border-2 rounded-full pin-l">Disconnect with this user.</button>
            </form>
        </div>
    @empty
        <div>
            You haven't offered to connect to anyone yet. Get out and sit on benches!
        </div>
    @endforelse <br><br>


@stop
