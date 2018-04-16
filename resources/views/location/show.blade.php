<?php /** @var \App\Location $location */ ?>
@extends('layout')

@section('content')

    @include('errors')

    <div class="relative">
        @if ($location->hasImage())
            <div class="h-64 bg-cover bg-center" style='background-image: url("{{ $location->getImage() }}");'></div>
        @endif
    </div>

    <div class="pt-8 border-b border-l border-r shadow mx-4 bg-white px-4 mb-4 relative z-10">
        <h1 class="text-3xl mx-auto text-center mb-2">{{ $location->name }}</h1>
        <p class="pb-4 leading-loose">
            {{ $location->description }}
        </p>
        @if ($location->hasEvent())
            <div title="An event is ongoing!" class="@if($location->hasImage()) pin-t -mt-6 @else pin-b -mb-6 @endif text-grey-darkest bg-yellow-lighter border-green-dark shadow border-2 absolute pin-r h-12 w-12 rounded-full text-center inline z-40" style="margin-right: 6em;">
                <span class="h-12 w-12 text-2xl leading-loose"><span class="fas fa-star"></span></span>
            </div>
        @endif
        <div class="@if($location->hasImage()) pin-t -mt-6 @else pin-b -mb-6 @endif text-grey-darkest bg-greengrey-lighter border-green-dark shadow border-2 absolute pin-r mr-8 h-12 w-12 rounded-full text-center inline z-40">
            <span class="h-12 w-12 text-2xl leading-loose">{{ $location->posts->count() }}</span>
        </div>

        @if($location->hasEvent())
            <div class="-mx-4 bg-yellow-lightest text-grey-darkest p-4">
                <h3 class=""><span class="fas fa-star"></span> An event is ongoing!</h3>
                <p class="py-2 leading-loose">
                    {{ $location->event_message }}
                </p>
                Until {{ $location->event_end->toDateString() }}
            </div>
        @endif
    </div>

    <div class="text-center">
        <hello-form authenticated="{{ Auth::check() }}" post-action="{{ URL::route('post.store', $location->id) }}" account-link="{{ URL::route('login', [ 'returnTo' => $location->id ]) }}" post-body="{{ old('body') }}"></hello-form>

    </div>

    @foreach($location->posts as $post)
        @include('partials.post')
    @endforeach
@stop
