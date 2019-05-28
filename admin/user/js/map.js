var directionsService
var directionsDisplay

function initMap() {
    console.log(document.getElementById('start').value)
    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: document.getElementById('start').value
    });
    directionsDisplay.setMap(map);

}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    directionsService.route({
        origin: document.getElementById('start').value,
        destination: document.getElementById('end').value,
        travelMode: 'DRIVING'
    }, function (response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

function openWindow() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
    let windowFloat = document.getElementById("floatWindow")
    windowFloat.style.display = "flex"
}

function cluseWindow() {
    let windowFloat = document.getElementById("floatWindow")
    windowFloat.style.display = "none"
}