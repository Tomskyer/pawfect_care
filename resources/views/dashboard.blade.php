<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($users as $user)
        <div class="bg-white shadow-sm sm:rounded-lg">
            <a href='{{ url("/view-profile/{$user->id}") }}'>
                <div class="flex flex-row">
                    <x-profile-picture-other picture="{{ $user->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-other>
                    <div class="flex flex-col">
                        <h1>{{ $user->name }}</h1>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        <?php
        $address = "16-18, Argyle Street, Camden, London, WC1H 8EG, United Kingdom";
        $result = app('geocoder')->geocode($address)->get();
        $coordinates = $result[0]->getCoordinates();
        $lat = $coordinates->getLatitude();
        $lng = $coordinates->getLongitude();

        ?>
        <h1>Lat: {{ $lat }} Long: {{ $lng }}</h1>
        <div class="container mt-5">
            <div id="map"></div>
        </div>

        <script type="text/javascript">
            function initMap() {
                //You can change LAT and LNG according to you're requirement
                const latLng = {
                    lat: <?php echo $lat; ?>,
                    lng: <?php echo $lng; ?>
                };

                console.log(latLng);

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 14,
                    center: latLng,
                });

                new google.maps.Marker({
                    position: latLng,
                    map,
                    title: "Location",
                });
            }

            window.initMap = initMap;
        </script>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
    </div>

</x-app-layout>