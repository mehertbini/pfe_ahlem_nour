<!DOCTYPE html>
<html>
<head>
    <title>Multiple Routes with Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map { height: 600px; }
    </style>
</head>
<body>

<h2 style="text-align: center;">Two Trajets with Leaflet</h2>
<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([36.8, 10.18], 12);

    // Base map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Trajet 1 (Example: Tunis to Ariana)
    const trajet1 = [
        [36.8065, 10.1815], // Tunis
        [36.8665, 10.1647]  // Ariana
    ];

    // Trajet 2 (Example: Tunis to La Marsa)
    const trajet2 = [
        [36.8065, 10.1815], // Tunis
        [36.8915, 10.3311]  // La Marsa
    ];

    // Draw polyline for Trajet 1 - Red
    L.polyline(trajet1, {color: 'red'}).addTo(map).bindPopup('Tunis to Ariana');

    // Draw polyline for Trajet 2 - Blue
    L.polyline(trajet2, {color: 'blue'}).addTo(map).bindPopup('Tunis to La Marsa');

    // Add markers for start points
    L.marker([36.8065, 10.1815]).addTo(map).bindPopup('Start: Tunis').openPopup();
</script>

</body>
</html>
