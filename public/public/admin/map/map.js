var Map = function () {

    var init = function () {
        initMap();
    };

    var marker =  new google.maps.Marker();
    var geocoder = new google.maps.Geocoder();
    var map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: 24.7136, lng: 46.6753},
        zoom: 15
    });
    var infoWindow = new google.maps.InfoWindow;


    var initMap = function () {

        var blat = document.getElementById('latbox').value;
        var blng = document.getElementById('lngbox').value;
        // Try HTML5 geolocation.
        if(!blat && !blng){

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    infoWindow.setContent("<p class='text-center pull-left' style = 'height:30px;width:200px'>Your Location</p>");
                    setValue(pos.lat,pos.lng);
                    geolocation(latlng,map);
                });
            }
        }
        else
        {
            map.setCenter(new google.maps.LatLng(blat, blng));
            var latlng = new google.maps.LatLng(blat, blng);
            geolocation(latlng,map);
        }



        google.maps.event.addListener(map, 'click', function(event) {

            marker.setMap(null);
            placeMarker(event.latLng,map);
            setValue(event.latLng.lat(),event.latLng.lng());

        });


        var input = document.getElementById('pac-input');

        var autocomplete = new google.maps.places.Autocomplete(
            input);
        autocomplete.bindTo('bounds', map);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


        var infowindowContent = document.getElementById('infowindow-content');
        infoWindow.setContent(infowindowContent);

        marker = new google.maps.Marker({
            map: map
        });
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            setValue(place.geometry.location.lat(), place.geometry.location.lng());
            if (!place.place_id) {
                return;
            }
            geocoder.geocode({'placeId': place.place_id}, function (results, status) {

                if (status !== 'OK') {
                    window.alert('Geocoder failed due to: ' + status);
                    return;
                }
                map.setZoom(11);
                map.setCenter(results[0].geometry.location);
                // Set the position of the marker using the place ID and location.
                marker.setPlace({
                    placeId: place.place_id,
                    location: results[0].geometry.location
                });
                marker.setVisible(true);


                infowindowContent.children['place-address'].textContent =
                    results[0].formatted_address;
                infowindow.open(map, marker);
            });
        });

    }

    var placeMarker = function (location,map) {

        marker = new google.maps.Marker({
            position: location,
            map: map
        });
        geocodePosition(location,map);
    }

    var geocodePosition =  function (pos,map) {

        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                marker.formatted_address = responses[0].formatted_address;
            } else {
                marker.formatted_address = 'Cannot determine address at this location.';
            }
            infoWindow.setContent(marker.formatted_address);
            infoWindow.open(map, marker);
        });
    }

    var geolocation = function(latlng,map){
        geocoder.geocode({'location': latlng}, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    map.setZoom(15);
                    placeMarker(latlng,map);

                } else {
                    window.alert('No results found');
                }

            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }


    var setValue = function(lat,lng){
        document.getElementById('latbox').value = lat;
        document.getElementById('lngbox').value = lng;
    }

    return {
        init: function () {
            init();
        }
    };

}();
jQuery(document).ready(function () {
    Map.init();
});
