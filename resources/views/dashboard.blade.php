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
        $auth_postcode = Auth::user()->postcode;
        $result = app('geocoder')->geocode($auth_postcode)->get();
        $auth_coordinates = $result[0]->getCoordinates();
        $auth_lat = $auth_coordinates->getLatitude();
        $auth_lng = $auth_coordinates->getLongitude();
        ?>
    </div>

</x-app-layout>