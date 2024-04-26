<?php
$profile_postcode = $requested_user->postcode;
$result1 = app('geocoder')->geocode($profile_postcode)->get();
if (isset($result1[0])) {
    $profile_coordinates = $result1[0]->getCoordinates();
    $profile_lat = $profile_coordinates->getLatitude();
    $profile_lng = $profile_coordinates->getLongitude();
}


$auth_postcode = Auth::user()->postcode;
$result2 = app('geocoder')->geocode($auth_postcode)->get();
if (isset($result2[0])) {
    $auth_coordinates = $result2[0]->getCoordinates();
    $auth_lat = $auth_coordinates->getLatitude();
    $auth_lng = $auth_coordinates->getLongitude();
}
?>
<div class="flex flex-col p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <h1 class="text-3xl text-semibold p-2">Location</h1>
    @if(isset($profile_coordinates) && isset($auth_coordinates))
    <div class="container mt-5">
        <div id="map"></div>
    </div>

    <script type="text/javascript">
        function initMap() {
            const latLng1 = {
                lat: <?php echo $profile_lat; ?>,
                lng: <?php echo $profile_lng; ?>
            };

            const latLng2 = {
                lat: <?php echo $auth_lat; ?>,
                lng: <?php echo $auth_lng; ?>
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: latLng1,
            });

            new google.maps.Marker({
                position: latLng1,
                map,
                title: "Profile's Location",
            });

            new google.maps.Marker({
                position: latLng2,
                map,
                title: "Your Location",
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 10,
                    fillOpacity: 1,
                    strokeWeight: 2,
                    fillColor: '#5384ED',
                    strokeColor: '#ffffff',
                },
            });

        }

        window.initMap = initMap;
    </script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
    @else
    <h1 class="text-3xl flex flex-col items-center text-semibold">Postcode does not exist; cannot show location</h1>
    @endif
</div>