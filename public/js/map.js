function initMap(latitud, longitud, zoom) {
    google.maps.event.addDomListener(window, "load", () => {
        var locate = { lat: latitud, lng: longitud };
        var map = new google.maps.Map(
            document.getElementById('map'),
            {
                center: locate,
                zoom: zoom
            }
        )

        // var contentString = '<b>Apple Store Cuenca</b>';

        // var infowindow = new google.maps.InfoWindow({
        //     content: contentString
        // });
        var marker = new google.maps.Marker(
            {
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: locate, map: map,
                //title: 'Tienda'
            }
        );
        marker.addListener('click', toggleBounce);

        function toggleBounce() {
            //infowindow.open(map, marker);
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }

    })


}


