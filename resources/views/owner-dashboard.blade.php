<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <div class="grid lg:grid-cols-2 sm:grid-cols-1">
            <?php
            $auth_postcode = Auth::user()->postcode;
            $result2 = app('geocoder')->geocode($auth_postcode)->get();
            if (isset($result2[0])) {
                $auth_coordinates = $result2[0]->getCoordinates();
                $auth_lat = $auth_coordinates->getLatitude();
                $auth_lng = $auth_coordinates->getLongitude();
            }


            ?>
            @foreach($users as $user)
            @if($user->role == 2)
            <?php
            $profile_postcode = $user->postcode;
            $result1 = app('geocoder')->geocode($profile_postcode)->get();
            if (isset($result1[0])) {
                $profile_coordinates = $result1[0]->getCoordinates();
                $profile_lat = $profile_coordinates->getLatitude();
                $profile_lng = $profile_coordinates->getLongitude();
            }
            

            if (isset($profile_lat) && isset($profile_lng)) {
                $distance = calculateDistance($auth_lat, $auth_lng, $profile_lat, $profile_lng);
            }
            
            ?>
            <a href='{{ url("/view-profile/{$user->id}") }}'>
                <div class="flex flex-row items-center justify-between mt-6 px-6 py-4 bg-white hover:bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
                    <div class="flex flex-row">
                        <x-profile-picture-other picture="{{ $user->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-other>
                        <div class="flex flex-col px-4 ">
                            <h1 class="font-bold">{{ $user->name }}</h1>
                            @if(isset($distance))
                            <p>{{ round($distance) }} miles</p>
                            @else
                            <p>Error: distance could not be calculated</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <h1>£15 an hour</h1>
                    </div>
                </div>
            </a>

            @endif
            @endforeach
        </div>
    </div>
</x-app-layout>