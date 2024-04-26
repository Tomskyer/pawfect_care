<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl flex flex-row">
                    <x-profile-picture-other picture="{{ $requested_user->picture }}" class="rounded-md w-40 h-40"></x-profile-picture-other>
                    <div class="flex flex-col ml-2">
                        <h1 class="text-3xl">{{ $requested_user->name }}</h1>
                        @if(Auth::user()->id == $requested_user->id)
                        <a href="{{ route('profile.edit') }}">
                            <button>Edit Profile</button>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                @foreach($dogs as $dog)
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <a href='{{ url("/view-profile-dog/{$dog->id}") }}'>
                        <div class="flex flex-row">
                            <x-profile-picture-dog-other picture="{{ $dog->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-dog-other>
                            <div class="flex flex-col">
                                <h1>{{ $dog->name }}</h1>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @if(Auth::user()->id == $requested_user->id && Auth::user()->id == 1)
            <a href="{{ route('profile_dog.create') }}">
                <button>Create Dog Profile</button>
            </a>
            @endif
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
    </div>
</x-app-layout>