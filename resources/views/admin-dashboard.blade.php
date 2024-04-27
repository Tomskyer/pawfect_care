<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
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