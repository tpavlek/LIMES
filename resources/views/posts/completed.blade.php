@extends('layout')

@section('title')
    Created a new post!
@stop

@section('content')
    Thanks for using Edmonton's Location Integrated Messaging and Experience Service! <BR>
    Your post will appear on this buddy bench shortly after moderator approval. <BR>
    We hope you have a nice day! <br>

    @if($post->hasImage())
        <img src="{{$post->getImage()}}"> <br>
    @endif


    <!-- Include some limes here -->
    <a href="{{url()->current()}}"> Back to location page </a>
@stop
