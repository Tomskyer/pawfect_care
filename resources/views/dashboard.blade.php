<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">
        @foreach($users as $user)
        @if(Auth::user()->role == 1 && $user->role == 2)
        <div class="bg-white shadow-md sm:rounded-lg">
            <a href='{{ url("/view-profile/{$user->id}") }}'>
                <div class="flex flex-row">
                    <x-profile-picture-other picture="{{ $user->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-other>
                    <div class="flex flex-col px-4 ">
                        <h1>{{ $user->name }}</h1>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @endforeach
        @if(Auth::user()->role == 2)
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
    </div>

</x-app-layout>