let map;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: 25.2048, lng: 55.2708},
        minZoom: 10,
    });

    map.addListener('click', function (event) {
        document.getElementById('long').value = event.latLng.lng();
        document.getElementById('lat').value = event.latLng.lat();
        placeMarker(event.latLng);
    });
    var marker

    function placeMarker(location) {
        if (marker)
            marker.setMap(null);
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }

    $(document).ready(function () {
        let long = $("input[name=long]").val();
        let lat = $("input[name=lat]").val();
        if (long && lat) {
            marker = new google.maps.Marker({
                position: {lat: Number(lat), lng: Number(long)},
            });
        }
        marker.setMap(map);
        let bounds = new google.maps.LatLngBounds();
        bounds.extend({lat: Number(lat), lng: Number(long)});
        map.fitBounds(bounds);

        zoomChangeBoundsListener =
            google.maps.event.addListenerOnce(map, 'bounds_changed', function (event) {
                if (this.getZoom()) {   // or set a minimum
                    this.setZoom(10);  // set zoom here
                }
            });

        setTimeout(function () {
            google.maps.event.removeListener(zoomChangeBoundsListener)
        }, 1000);
    });

    // const card = document.getElementById("pac-card");
    const input = document.getElementById("map-input");
    // const biasInputElement = document.getElementById("use-location-bias");
    // const strictBoundsInputElement = document.getElementById("use-strict-bounds");
    const options = {
        fields: ["formatted_address", "geometry", "name"],
        strictBounds: false,
        types: ["establishment"],
    };

    // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

    const autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.bindTo("bounds", map);

    const infowindow = new google.maps.InfoWindow();
    const infowindowContent = document.getElementById("infowindow-content");

    infowindow.setContent(infowindowContent);
    const newmarker = new google.maps.Marker({
        map,
        anchorPoint: new google.maps.Point(0, -29),
    });


    autocomplete.addListener("place_changed", (event) => {
        infowindow.close();
        newmarker.setVisible(false);

        const place = autocomplete.getPlace();
        document.getElementById('long').value =  place.geometry.location.lng();
        document.getElementById('lat').value = place.geometry.location.lat();

        if (!place.geometry || !place.geometry.location) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(10);
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        infowindowContent.children["place-name"].textContent = place.name;
        infowindowContent.children["place-address"].textContent =
            place.formatted_address;
        infowindow.open(map, marker);
    });
}


