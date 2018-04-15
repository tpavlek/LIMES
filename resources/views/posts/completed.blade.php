@extends('layout')

@section('title')
    Created a new post!
@stop

@section('content')

    <div class="text-center p-8 text-5xl text-green-dark">
        <span class="fas fa-lemon"></span> &nbsp; <span class="fas fa-check"></span>
    </div>

    <div class="p-2 border-t border-l border-r mx-4 bg-white px-4 relative z-10 mt-2 rounded-top leading-loose">
        <h2 class="text-grey-darkest">Post Created!</h2>
        <p>
            Thanks for using Edmonton's Location Integrated Messaging and Experience Service!
        </p>
        <p>
            Your post will appear shortly, and will look a little something like this:
        </p>
    </div>

    @include('partials.post')

    <div class="text-center">
        <a class="no-underline bg-green-dark text-white p-4 mx-auto border-blue-darkest leading-loose shadow rounded mb-4" href="{{ URL::route('location', $post->location->id) }}">
            Check it out!
        </a>
    </div>

@stop
