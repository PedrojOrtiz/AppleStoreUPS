function loadMap(usulat, usulong, lat, long, zoom, store, direccion) {
    var map = L.map('map').setView([lat, long], zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // L.marker([lat, long]).addTo(map)
    //     .bindPopup("<b>Apple Store " + store + "</b><br/>" + direccion).openPopup();

    // L.marker([usulat, usulong]).addTo(map)
    //     .bindPopup("<b>Miubicacion</b><br />").openPopup();

    L.Routing.control({
        waypoints: [
            L.latLng(usulat, usulong),
            L.latLng(lat, long)
        ],
        routeWhileDragging: true,
    }).addTo(map);

    var testMarker = L.marker([lat, long]).bindPopup('<b>Apple Store ' + store + '</b><br/>' + direccion);
    var testMarkerTwo = L.marker([usulat, usulong]).bindPopup('<b>Mi ubicacion</b>');
    var markerGroup = L.featureGroup([testMarker, testMarkerTwo]).addTo(map);
    markerGroup.eachLayer(function (layer) {
        layer.openPopup();
    });
}