
<!DOCTYPE html>
<html>
  <head>

    <style>
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        #map {
        height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
        height: 100%;
        margin: 0;
        padding: 0;
        }
    </style>
    <script>
        function initMap() {

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 11,
                center: { lat:  {{ $lat }}, lng: {{ $lon }} }, //ROZA location
            });

            const last_30_days  = "https://maps.google.com/mapfiles/ms/icons/red-dot.png";
            const last_7_days   = "https://maps.google.com/mapfiles/ms/icons/orange-dot.png";
            const yesterday     = "https://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
            const today         = "https://maps.google.com/mapfiles/ms/icons/green-dot.png";  

            var today_users = 0;
            var yesterday_users = 0;

            @php
                foreach($map_data as $index => $marker){
                    @endphp

                    lat = {{ $marker['lat'] }};
                    lon = {{ $marker['lon'] }};
                    last_access = {{ $marker['last_access'] }}; //in hour

                    if(last_access <= 24){
                        var icon = today;
                        today_users++;                        
                    }else if(last_access > 24 && last_access <= 48){
                        var icon = yesterday;
                        yesterday_users++;
                    }else if(last_access > 48 && last_access <= 168){
                        var icon = last_7_days;
                    }else{
                        var icon = last_30_days;
                    }

                    marker = [];
                    infowindow = [];

                    marker[{{$index}}] = new google.maps.Marker({
                        position: { lat: lat, lng: lon},
                        map,
                        title: "{{ $marker['name'] }}, {{ $marker['phone'] }}, {{ $marker['last_access'] }} Hours Ago, {{ $marker['date_time'] }}",
                        animation: google.maps.Animation.DROP,
                        icon: icon,
                    });

                    // infowindow[{{$index}}] = new google.maps.InfoWindow({
                    //     content: '<div id="content">'+
                    //     '<div id="siteNotice">'+
                    //     '</div>'+
                    //     '<h2 id="firstHeading" class="firstHeading">Uluru</h2>'+
                    //     '</div>',
                    // });

                    // google.maps.event.addListener(marker[{{$index}}], 'click', function() {
                    //     infowindow[{{$index}}].open(map,marker[{{$index}}]);
                    // });
                    @php
                }

                
            @endphp

            alert(today_users+" Users in Last 24 Hrs\n"+yesterday_users+" Users in Last 48 Hrs.");
            document.title = today_users+" Users in Last 24 Hours";
        }
    </script>
  </head>
  <body>
    <div id="map"></div>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=Key here&callback=initMap&v=weekly"
      async
    ></script>
  </body>
</html>