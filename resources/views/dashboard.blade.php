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
        $postcode = "ST179TA";
        $result = app('geocoder')->geocode($postcode)->get();
        $coordinates = $result[0]->getCoordinates();
        $lat = $coordinates->getLatitude();
        $lng = $coordinates->getLongitude();

        ?>
        <div class="container mt-5">
            <div id="map"></div>
        </div>

        <script type="text/javascript">
            function initMap() {
                const latLng1 = {
                    lat: <?php echo $lat; ?>,
                    lng: <?php echo $lng; ?>
                };

                const latLng2 = {
                    lat: 0,
                    lng: -50
                };

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 16,
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
    </div>

</x-app-layout>