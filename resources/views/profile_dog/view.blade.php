<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col items-center p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <h1 class="text-3xl items-center text-semibold p-2">About {{ $dog->name }}</h1>
                <x-profile-picture-dog-other picture="{{ $dog->picture }}" class="rounded-md w-80 h-80"></x-profile-picture-dog-other>


                <a class="mt-4" href="{{ route('profile.view', ['id' => $dog->owner_id]) }}">
                    <x-primary-button-alt>View Owner Profile</x-primary-button-alt>
                </a>

            </div>
            <div class="flex flex-col items-center p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col items-center border border-gray-300 rounded-md mx-4 p-2">
                        <p class="text-gray-500">Breed</p>
                        <h1 class="text-xl">{{ $dog->breed }}</h1>
                    </div>
                    <div class="flex flex-col items-center border border-gray-300 rounded-md mx-4 p-2">
                        <p class="text-gray-500">Age</p>
                        <h1 class="text-xl">{{ floor((time() - strtotime($dog->birthdate))/31556926); }} years old</h1>
                    </div>
                    <div class="flex flex-col items-center border border-gray-300 rounded-md mx-4 p-2">
                        <p class="text-gray-500">Size</p>
                        <h1 class="text-xl">{{ $dog->size }}kg</h1>
                    </div>
                    <div class="flex flex-col items-center border border-gray-300 rounded-md mx-4 p-2">
                        <p class="text-gray-500">Neutered?</p>
                        <h1 class="text-xl">{{ $dog->neutered }}</h1>
                    </div>
                </div>
                <div class="mt-4 border border-gray-300 rounded-md w-full">
                @if(isset($dog->about))
                
                    <p class="text-gray-500 text-center">Description</p>
                    <p class="text-center p-4">{{ $dog->about }}</p>
                    
                @else

                    <p class="text-center p-4">No description available</p>
                
                @endif
                </div>
            </div>
        </div>
</x-app-layout>