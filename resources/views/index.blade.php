@extends('layout')

@section('content')
    Look at all the places you can go in Edmonton!

    <div id="map" style="height:500px;width:500px;"></div>
        <script>
            function initMap() {
                //For some reason mustache notation doesn't work....
                var location_string = <?php echo $locations ?>;
                var locations = JSON.parse(JSON.stringify(location_string));
                var edmonton = {lat: 53.5444, lng: -113.4909};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: edmonton
                });

                locations.forEach(function (element) {
                    new google.maps.Marker({
                        position: {lat:Number(element[1]), lng:Number(element[2])},
                        map: map,
                        title: element[0],
                        icon: "http://icons.iconarchive.com/icons/icons8/windows-8/24/City-City-Bench-icon.png"
                    })
                })

            }
        </script>
    </div>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBulaltfqPDjhXfHmWQmv-OXO3Tz4fLw_8&callback=initMap">
    </script>

@stop
