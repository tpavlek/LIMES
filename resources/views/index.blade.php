@extends('layout')

@section('content')

    <div class="p-2 border-t border-l border-r mx-4 bg-white px-4 relative z-10 mt-2 rounded-top">
        <h2 class="text-grey-darkest">Find somewhere to say Hello</h2>
    </div>
    <div id="map" class="w-full h-64"></div>

    @foreach($locations as $location)
        @include('partials.location_summary')
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
