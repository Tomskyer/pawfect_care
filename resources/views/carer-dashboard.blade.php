<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        @if(Auth::user()->role == 2)
        @if(Auth::user()->carer_verified == 'false')
        <div class="w-full flex flex-col items-center">
            <h1 class="text-3xl ext-semibold">A member of our staff team will need to verify you</h1>
        </div>
        @elseif(Auth::user()->carer_verified == 'pending')
        @else
        @foreach($dogs as $dog)
        <div class="bg-white shadow-md sm:rounded-lg">
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
        @endif
        @endif
    </div>
</x-app-layout>