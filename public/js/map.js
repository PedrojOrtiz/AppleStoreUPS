function loadMap(lat, long, zoom, store, direccion) {
    var map = L.map('map').setView([lat, long], zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, long]).addTo(map)
        .bindPopup("<b>Apple Store " + store + "</b><br/>" + direccion).openPopup();
}