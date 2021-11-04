<!doctype html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark-theme"> -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/attachment/favicon.png') }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
	<title>@yield('title',config('app.name', 'Laravel')." - ".config('app.slogan', 'Laravel'))</title>
</head>

<body>
	<!--wrapper-->
        <div id="map"></div>
        <div id="msg"></div>

    <script>
        // Initialize and add the map
        var map;
        function initMap() {
            // The map, centered on Central Park
            const center = { lat: 24.915857, lng: 67.125187 };
            const options = { zoom: 15, scaleControl: true, center: center };
            map = new google.maps.Map(
                document.getElementById('map'), options);
            // Locations of landmarks
            const point1 = { lat: 24.915857, lng: 67.125187 };
            const point2 = { lat: 24.7923188, lng: 67.066965 };
            // The markers for The point1 and The point2 Collection
            var mk1 = new google.maps.Marker({ position: point1, map: map });
            var mk2 = new google.maps.Marker({ position: point2, map: map });

            // Draw strait line between two points
            // var line = new google.maps.Polyline({ path: [point1, point2], map: map });

            // Formula to calculate strait line distance between these points
            function haversineDistance(mk1, mk2) {
                var rad = 6371.0710; // Radius of the Earth in kms
                var rlat1 = mk1.position.lat() * (Math.PI / 180); // Convert degrees to radians
                var rlat2 = mk2.position.lat() * (Math.PI / 180); // Convert degrees to radians
                var difflat = rlat2 - rlat1; // Radian difference (latitudes)
                var difflon = (mk2.position.lng() - mk1.position.lng()) * (Math.PI / 180); // Radian difference (longitudes)

                var d = 2 * rad * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)));
                return d;
            }

            // Call method to get distance and print.
            var distance = haversineDistance(mk1, mk2);
            document.getElementById('msg').innerHTML = "Distance between markers: " + distance.toFixed(2) + " Kms.";

            // Travel Distance
            let directionsService = new google.maps.DirectionsService();
            let directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map); // Existing map object displays directions
            // Create route from existing points used for markers
            const route = {
                origin: point1,
                destination: point2,
                travelMode: 'DRIVING',
                provideRouteAlternatives: true
            }

            directionsService.route(route,
                // capture directions
                function (response, status) {
                    if (status !== 'OK') {
                        window.alert('Directions request failed due to ' + status);
                        return;
                    } else {
                        directionsRenderer.setDirections(response); // Add route to the map
                        var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
                        if (!directionsData) {
                            window.alert('Directions request failed');
                            return;
                        } else {
                            document.getElementById('msg').innerHTML += " Travel distance is " + directionsData.distance.text + " (" + directionsData.duration.text + ").";
                        }
                    }
                });
        }
    </script>
    <!-- replace api key below -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0k5eKvAEjLA5lU2QRHFtOqeGmai-vpe0&callback=initMap">
    </script>
</body>
</html>
