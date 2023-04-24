<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Current Location</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/esri-leaflet@2.1.2/dist/esri-leaflet.js"></script>
</head>

<body>

    <script>
        var map ;

        navigator.geolocation.getCurrentPosition(function(location) {
            var latlng = L.latLng(location.coords.latitude, location.coords.longitude);
            map= L.map('map').setView(latlng, 15);
            map.setView(latlng, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
            }).addTo(map);
            addMarker(latlng);
        });


        function addMarker(latlng) {
            var marker = L.marker(latlng, {
                draggable: true
            }).addTo(map);

            // var popupContent = "<button onclick='removeMarker(" + (markers.length - 1) + ")'>Remove Marker</button>";
            // marker.bindPopup(popupContent);
            marker.on('dragend', function(e) {
                console.log(e.target.getLatLng());
            });
        }
    </script>
</body>

</html>
