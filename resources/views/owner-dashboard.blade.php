<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 h-screen">
        <div class="flex flex-row items-center justify-between ">
            <h1 class="text-gray-600">Sorted by nearest</h1>
            <div>
                <form method="GET" action="{{ route('owner-dashboard') }}">
                    <select onchange="this.form.submit()" name="service_id" id="service" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option>Select a service</option>
                        @foreach($services as $service)
                        @if($selected_service != null)
                        @if($selected_service->id == $service->id)
                        <option value="{{ $service->id }}" selected>Dog {{ $service->name }}</option>
                        @else
                        <option value="{{ $service->id }}">Dog {{ $service->name }}</option>
                        @endif
                        @else
                        <option value="{{ $service->id }}">Dog {{ $service->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </form>
            </div>

        </div>
        <div class="grid lg:grid-cols-2 sm:grid-cols-1">
            @if($selected_service != null)
            @foreach($users as $user)
            @foreach($users_services as $pivot)
            @if($pivot->user_id == $user->id && $pivot->service_id == $selected_service->id)
            <a class="mt-2 py-2 px-2" href='{{ url("/view-profile/{$user->id}") }}'>
                <div class="flex flex-row items-center justify-between bg-white hover:bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
                    <div class="flex flex-row">
                        <x-profile-picture-other picture="{{ $user->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-other>
                        <div class="flex flex-col px-4">
                            <h1 class="font-bold">{{ $user->name }}</h1>
                            @if($user->distance != null)
                            <p>{{ round($user->distance) }} miles</p>
                            @else
                            <p>Error: distance could not be calculated</p>
                            @endif
                        </div>
                    </div>
                    <div class="px-4 font-bold">
                        £{{ $pivot->price }} an hour
                    </div>
                </div>
            </a>
            @endif
            @endforeach
            @endforeach
            @else
            @foreach($users as $user)
            <a class="mt-2 py-2 px-2" href='{{ url("/view-profile/{$user->id}") }}'>
                <div class="flex flex-row items-center justify-between bg-white hover:bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
                    <div class="flex flex-row">
                        <x-profile-picture-other picture="{{ $user->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-other>
                        <div class="flex flex-col px-4">
                            <h1 class="font-bold">{{ $user->name }}</h1>
                            @if($user->distance != null)
                            <p>{{ round($user->distance) }} miles</p>
                            @else
                            <p>Error: distance could not be calculated</p>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            @endif

        </div>
    </div>
</x-app-layout>