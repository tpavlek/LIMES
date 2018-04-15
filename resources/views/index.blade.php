@extends('layout')

@section('content')

    <div class="p-2 border-t border-l border-r mx-4 bg-white px-4 relative z-10 mt-2 rounded-top">
        <h2 class="text-grey-darkest">Find somewhere to say Hello</h2>
    </div>
    <div id="map" class="w-full h-64"></div>

    @foreach($locations as $location)
        <a class="block h-16 bg-white border-b flex no-underline" href="https://www.google.com/maps/place/{{ $location->lat }},{{ $location->lon }}">
            <div class="inline-block w-1/4 bg-cover bg-center h-full" style='background-image: url("{{ $location->getImage() }}");'>
            </div>
            <div class="inline-block text-grey-darkest flex-grow h-full p-2">
                <h3 class="pb-2">{{ $location->name }}</h3>
                <div class="">
                    <span class="text-grey-dark text-small font-bold"><i class="fas fa-comment"></i> &nbsp; {{ $location->posts()->count() }}</span>
                </div>
            </div>
        </a>
    @endforeach

@stop

@section("scripts")

    <script>
        function initMap() {
            var locations = JSON.parse('{!! $json_locations !!}');
            var edmonton = { 'lat': Number(locations[0][1]), 'lng': Number(locations[0][2]) };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: edmonton
            });

            locations.forEach(function (element) {
                new google.maps.Marker({
                    position: {lat:Number(element[1]), lng:Number(element[2])},
                    map: map,
                    title: element[0],
                    icon: "https://icons.iconarchive.com/icons/icons8/windows-8/24/City-City-Bench-icon.png"
                })
            })

        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBulaltfqPDjhXfHmWQmv-OXO3Tz4fLw_8&callback=initMap">
    </script>
@stop
