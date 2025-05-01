<!DOCTYPE html>
<html>
<head>
    <title>Leaflet Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <style>
        #map { height: 100vh; width: 100%; }
    </style>
</head>
<body>

<div id="map"></div>

<script>
    const start = { lat: {{ $startLat }}, lng: {{ $startLng }} };
    const end = { lat: {{ $endLat }}, lng: {{ $endLng }} };

    const map = L.map('map').setView([start.lat, start.lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Route
    L.Routing.control({
        waypoints: [
            L.latLng(start.lat, start.lng),
            L.latLng(end.lat, end.lng)
        ],
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false
    }).addTo(map);

    // Real-time location tracking
    let userMarker = null;

    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(
            function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                if (userMarker) {
                    userMarker.setLatLng([lat, lng]);
                } else {
                    userMarker = L.marker([lat, lng], {
                        icon: L.icon({
                            iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32]
                        })
                    }).addTo(map).bindPopup("You are here").openPopup();

                    map.setView([lat, lng], 14);
                }
            },
            function (error) {
                console.error("Geolocation error:", error.message);
            },
            {
                enableHighAccuracy: true
            }
        );
    } else {
        alert("Geolocation is not supported by this browser.");
    }
</script>


</body>
</html>
