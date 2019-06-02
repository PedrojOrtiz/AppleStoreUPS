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
            window.alert('Direccion no encontrada. ' + status);
        }
    });
}

function cluseWindow() {
    let windowFloat = document.getElementById("floatWindow")
    windowFloat.style.display = "none"
}

function mapDirection(storeID) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("mapDir").innerHTML = this.responseText
            calculateAndDisplayRoute(directionsService, directionsDisplay);
            let windowFloat = document.getElementById("floatWindow")
            windowFloat.style.display = "flex"
        }
    };
    xmlhttp.open("GET", "../controller/mapDirection.php?storeId=" + storeID, true)
    xmlhttp.send()
}