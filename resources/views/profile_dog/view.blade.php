<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl flex flex-row">
                    <x-profile-picture-dog-other picture="{{ $dog->picture }}" class="rounded-md w-40 h-40"></x-profile-picture-dog-other>
                    <div class="flex flex-col ml-2">
                        <h1 class="text-3xl">{{ $dog->name }}</h1>
                        <a href="{{ route('profile.view', ['id' => $dog->owner_id]) }}">
                            <button>View Owner Profile</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>