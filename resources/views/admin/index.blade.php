@extends('layout')

@section('content')
    <div class="p-2 border-t border-l border-r mx-4 bg-white px-4 relative z-10 mt-2 rounded-top">
        <h2 class="text-grey-darkest">Current Locations</h2>
    </div>
    <div class="p-4 bg-yellow-lighter text-grey-darkest">
        <h3><span class="fas fa-info-circle"></span> LIMES integrates with open data!</h3>
        <p class="py-2">
            Did you know you can easily import locations from the open data catalogue? Any dataset with co-ordinates will
            do!
        </p>
        <div class="text-center pt-2">
            <a href="{{ URL::route('admin.opendata_import') }}" class="no-underline bg-grey-lightest text-grey-darkest px-4 py-2 mx-auto border leading-loose shadow rounded mb-4">
                Import
            </a>
        </div>

    </div>
    @forelse($locations as $location)
        @include('partials.location_summary', ['link_to' => 'admin' ])
    @empty
        <em>There are no locations configured</em>
    @endforelse
@stop
