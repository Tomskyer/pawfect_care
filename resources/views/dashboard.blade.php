<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">
        <?php
        $auth_postcode = Auth::user()->postcode;
        $result2 = app('geocoder')->geocode($auth_postcode)->get();
        if (isset($result2[0])) {
            $auth_coordinates = $result2[0]->getCoordinates();
            $auth_lat = $auth_coordinates->getLatitude();
            $auth_lng = $auth_coordinates->getLongitude();
        }
        ?>
        <!-- Owner view -->
        

        <!-- Carer view -->
        

</x-app-layout>