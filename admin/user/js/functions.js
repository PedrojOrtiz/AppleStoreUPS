// function openWindow() {

//     let windowFloat = document.getElementById("floatWindow")
//     windowFloat.style.display = "flex"

// }

// function cluseWindow() {
//     let windowFloat = document.getElementById("floatWindow")
//     windowFloat.style.display = "none"
// }

// function loadMap(usuLat, usuLong, storeLat, storeLong) {

//     var map = L.map('map').setView([usuLat, usuLong], 20);

//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
//     }).addTo(map);

//     // L.marker([usuLat, usuLong]).addTo(map)
//     //     .bindPopup('Mi ubicacion.')
//     //     .openPopup();

//     // L.marker([storeLat, storeLong]).addTo(map)
//     //     .bindPopup('Tienda.')
//     //     .openPopup();

//     L.Routing.control({
//         waypoints: [
//             L.latLng(usuLat, usuLong),
//             L.latLng(storeLat, storeLong)
//         ],
//         routeWhileDragging: true,
//     }).addTo(map);
// }