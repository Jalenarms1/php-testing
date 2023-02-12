function initMap() {
    var location = {lat: 42.84919, lng: -91.19218};
    var map = new google.maps.Map(document.getElementById('map'), {zoom: 14, center: location});
    var marker = new google.maps.Marker({position: location, map: map});
}

