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
        <h1 class="text-3xl mx-auto text-center mb-2">{{ $location->name }}</h1>
        <p class="pb-8 leading-loose">
            {{ $location->description }}
        </p>

        <a class="block bg-grey-light absolute pin-b pin-r -mb-6 m-4 h-12 w-12 rounded-full text-center inline z-40">
            <span class="fas fa-comment h-12 w-12 text-grey-dark"></span>
        </a>
    </div>

    <div class="text-center">
        <button class="bg-green-dark hover:bg-green-darker text-white px-4 py-2 border-green-darkest text-xl leading-loose shadow rounded mb-4">
            <span class="fas fa-comment"></span> Say Hello
        </button>
    </div>

    @forelse($location->posts as $post)
        <div class="mx-4">
            <div class="relative">

                @if ($post->hasImage())
                    <div class="h-64 bg-cover bg-center" style='background-image: url("{{ $post->getImage() }}");'></div>
                @endif
                    <div class="@if($post->hasImage()) pin-b -mb-8 @else pin-t -mt-6 @endif border-green-dark shadow border-2 absolute pin-l ml-6 h-16 w-16 rounded-full text-center inline z-40 bg-center bg-cover" style='background-image: url("{{ $post->author->getImage() }}");'>
                    </div>
            </div>

            <div class="border-b border-l border-r shadow bg-white mb-8 z-10">
                <div class="pt-2 text-sm font-bold tracking-wide text-grey-dark" style="margin-left:6rem;">{{ strtoupper($post->author->name) }}</div>
                <p class="p-4 text-left leading-loose">
                    {{ $post->body }}
                </p>

            </div>
        </div>
    @empty
        <span class="text-2xl">No one has said hello yet!</span>
    @endforelse
@stop
