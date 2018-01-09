<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.10.2017
 * Time: 14:57
 */?>

<!DOCTYPE html>
<html>
<head>
    <style>
        #map {
            width: 100%;
            height: 400px;
            background-color: grey;
        }
    </style>
</head>
<body>
<h3>My Google Maps Demo</h3>
<div id="map"></div>
<script>
    function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP_wnDUTMredO4vurBeSZPP23vwoE1qu8&callback=initMap">
</script>
</body>
</html>

