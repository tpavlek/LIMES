@extends('layout')

@section('title')
    Created a new post!
@endsection

@section('content')
    Thanks for using Edmonton's Location Integrated Messaging and Experience Service! <BR>
    Your post will appear on this buddy bench shortly after moderator approval. <BR>
    We hope you have a nice day! <br>

    <img src="/storage/{{$image_url}}"> <br>

    <!-- Include some limes here -->
    <a href="/"> Back to LIMES homepage~~ </a>
@endsection