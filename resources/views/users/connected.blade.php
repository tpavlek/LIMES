@extends('layout')

@section('title')
    You've sent a connection request!
@stop

@section('content')

    <div class="text-center p-8 text-5xl text-green-dark">
        <span class="fas fa-lemon"></span> &nbsp; <span class="fas fa-link"></span>
    </div>

    <div class="p-2 border-t border-l border-r mx-4 bg-white px-4 relative z-10 mt-2 rounded-top leading-loose">
        <h2 class="text-grey-darkest">Connected with {{ $user_name }}</h2>
        <p>
            Thanks for using Edmonton's <strong>L</strong>ocation <strong>I</strong>ntegrated <strong>M</strong>essaging and <strong>E</strong>xperience <strong>S</strong>ervice!
        </p>
        <p>
            You might hear from them soon. Go out and meet some more new folks!
        </p>
    </div>

    <div class="text-center">
        <a class="no-underline bg-green-dark text-white p-4 mx-auto border-blue-darkest leading-loose shadow rounded mb-4" href="/">
            Find Somewhere New
        </a>
    </div>
@stop
