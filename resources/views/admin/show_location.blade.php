<?php /** @var \App\Location $location */ ?>
@extends('layout')

@section('content')
    <div class="p-4 mx-4 border-b border-l border-r shadow bg-white">
        <form action="{{ URL::route('admin.update_location', $location->id) }}" method="post"
              enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

            @include('partials/formfield/text', [ 'name' => 'name', 'value' => $location->name ])
            <textarea class="bg-grey-light p-2 rounded w-full h-32 mb-2" id="description" name="description"
                      title="Description" placeholder="Description">{{ $location->description }}</textarea>

            @include('partials/formfield/text', [ 'name' => 'ref_uuid', 'display_name'=> 'uuid', 'value' => $location->ref_uuid ])

            @include('partials/formfield/text', [ 'name' => 'lat', 'display_name'=> 'latitude', 'value' => $location->lat ])

            @include('partials/formfield/text', [ 'name' => 'lon', 'display_name'=> 'longitude', 'value' => $location->lon ])

            <image-upload></image-upload>

            <hr class="border-b"/>
            <div class="">
                @if($location->hasEvent())
                    There is currently an event going on! Details:
                @else
                    There is no current event! Next event:
                @endif
            </div>

            <div class="py-2">
                <label for="event_start" class="tracking-wide font-bold text-sm text-grey-dark">
                    START
                </label>
                <input type="date" id="event_start" name="event_start"
                       min={{date("Y-m-d")}} value={{$location->event_start}}> <br>
            </div>
            <div class="py-2">
                <label for="event_end" class="tracking-wide font-bold text-sm text-grey-dark">
                    END
                </label>
                <input type="date" id="event_end" name="event_end" min={{date("Y-m-d")}} value={{$location->event_end}}>
                <br>
            </div>
            <textarea class="bg-grey-light p-2 rounded w-full h-32 mb-2" id="event_message" name="event_message"
                      title="Event Message" placeholder="Event Message">{{ $location->event_message }}</textarea>

            @include('errors')
            <hr class="border-t"/>

            <button type="submit"
                    class="bg-green-dark text-white px-4 py-2 mx-auto border-blue-darkest leading-loose shadow rounded mb-4">
                <i class="fas fa-save"></i> Save
            </button>
        </form>
    </div>
@stop
