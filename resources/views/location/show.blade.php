<?php /** @var \App\Location $location */ ?>
@extends('layout')

@section('content')

    @include('errors')

    <div class="relative">
        <div class="h-64 bg-cover bg-center" style='background-image: url("{{ $location->getImage() }}");'></div>
        <div class="bg-greengrey-lighter border-green-dark shadow border-2 absolute pin-b pin-r mr-8 -mb-6 h-12 w-12 rounded-full text-center inline z-40">
            <span class="h-12 w-12 text-2xl leading-loose">{{ $location->posts->count() }}</span>
        </div>
    </div>

    <div class="pt-8 border-b border-l border-r shadow mx-4 bg-white px-4 mb-4 relative z-10">
        <h1 class="text-3xl mx-auto text-center mb-2">{{ $location->name }}</h1>
        <p class="pb-4 leading-loose">
            {{ $location->description }}
        </p>
    </div>

    <div class="text-center">
        <hello-form authenticated="{{ Auth::check() }}" post-action="{{ URL::route('post.store', $location->id) }}" account-link="{{ URL::route('login', [ 'returnTo' => $location->id ]) }}" post-body="{{ old('body') }}"></hello-form>

    </div>

    @forelse($location->posts as $post)
        <div class="mx-4">
            <div class="relative">

                @if ($post->hasImage())
                    <div class="h-64 bg-cover bg-center" style='background-image: url("{{ $post->getImage() }}");'></div>
                @endif
                    <div class="@if($post->hasImage()) pin-b -mb-8 @else pin-t -mt-6 @endif border-green-dark shadow border-2 absolute pin-l ml-4 h-16 w-16 rounded-full text-center inline z-40 bg-center bg-cover" style='background-image: url("{{ $post->author->getImage() }}");'>
                    </div>
            </div>

            <div class="border-b border-l border-r shadow bg-white mb-8 z-10">
                <div class="pt-2 text-sm font-bold tracking-wide text-grey-darker" style="margin-left:6rem;">{{ strtoupper($post->author->name) }}</div>
                <p class="p-4 text-left leading-loose">
                    {{ $post->body }}
                </p>

                @if(!$post->hasAnonymousAuthor())
                    <form action="{{route('add_connection', ['id' => $post->author->id])}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="btn bg-blue-light shadow border-2 rounded-full pin-l">Connect with this user.</button>
                    </form>
                @endif

            </div>
        </div>
    @empty
        <span class="text-2xl">No one has said hello yet!</span>
    @endforelse
@stop
