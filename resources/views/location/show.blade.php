<?php /** @var \App\Location $location */ ?>
@extends('layout')

@section('content')

    <div class="relative">
        <div class="h-64 bg-cover bg-center" style='background-image: url("{{ $location->getImage() }}");'></div>
        <div class="bg-green-lightest border-green-dark shadow border-2 absolute pin-b pin-r mr-8 -mb-6 h-12 w-12 rounded-full text-center inline z-40">
            <span class="h-12 w-12 text-2xl leading-loose">{{ $location->posts->count() }}</span>
        </div>
    </div>

    <div class="pt-8 border-b border-l border-r shadow mx-4 bg-white px-4 mb-8 relative z-10">
        <h1 class="text-2xl mx-auto text-center mb-2">{{ $location->name }}</h1>
        <p class="pb-8">
            {{ $location->description }}
        </p>

        <a class="block bg-red-lighter absolute pin-b pin-r -mb-6 m-4 h-12 w-12 rounded-full text-center inline z-40">
            <span class="fas fa-comment h-12 w-12"></span>
        </a>
    </div>

    <div>

        <br />
        <br />
        <br /><br /><br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
    </div>


@stop
