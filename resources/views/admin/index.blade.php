@extends('layout')

@section('content')
    <h1>Current Locations</h1>
    @forelse($locations as $location)
        <a class="p-2 block border no-underline bg-white" href="{{ URL::route('admin.show_location', $location->id) }}">
            {{ $location->name }} ({{ $location->posts->count() }})
        </a>
    @empty
        <em>There are no locations configured</em>
    @endforelse
@stop
