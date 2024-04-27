<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <!-- Owner view -->
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

        <!-- Carer view -->
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

        <!-- Admin view -->
        @if(Auth::user()->role == 3)
        @if (session('status') === 'carer-verified')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-2xl flex flex-col items-center text-gray-600">{{ __('Carer Verified.') }}</p>
        @endif
        @foreach($users as $user)
        @if($user->carer_verified == 'false' && $user->role == 2)
        <div class="w-full flex flex-row items-center justify-between mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <a href='{{ url("/view-profile/{$user->id}") }}'>
                <div class="flex flex-row">
                    <x-profile-picture-other picture="{{ $user->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-other>
                    <div class="flex flex-col px-4 ">
                        <h1>{{ $user->name }}</h1>
                    </div>
                </div>
            </a>
            <form method="POST" action="{{ route('profile.verify') }}">
                @csrf
                @method('patch')

                <input name="id" value="{{ $user->id }}" hidden />
                <x-primary-button class="ms-4">
                    Verify carer
                </x-primary-button>
            </form>
        </div>
        @endif
        @endforeach
        @endif
    </div>

</x-app-layout>