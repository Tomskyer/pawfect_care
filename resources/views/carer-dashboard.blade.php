<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        @if(Auth::user()->carer_verified == 'false')
        <div class="w-full flex flex-col items-center">
            <h1 class="text-3xl ext-semibold">A member of our staff team will need to verify you</h1>
        </div>
        @else
        <div class="grid lg:grid-cols-2 sm:grid-cols-1">
            @foreach($dogs as $dog)
            <a class="mt-2 py-2 px-2" href='{{ url("/view-profile-dog/{$dog->id}") }}'>
                <div class="flex flex-row items-center justify-between bg-white hover:bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
                    <div class="flex flex-row">
                        <x-profile-picture-dog-other picture="{{ $dog->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-dog-other>
                        <div class="flex flex-col px-4">
                            <h1 class="font-bold">{{ $dog->name }}</h1>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            @endif
        </div>
    </div>
</x-app-layout>