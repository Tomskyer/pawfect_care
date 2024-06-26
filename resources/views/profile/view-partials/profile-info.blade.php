<!-- Profile info -->
<div class="flex flex-col p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-xl flex flex-row">
        <x-profile-picture-other picture="{{ $requested_user->picture }}" class="rounded-md w-40 h-40"></x-profile-picture-other>
        <div class="flex flex-col ml-2">
            <h1 class="text-3xl">{{ $requested_user->name }}</h1>
            @if(Auth::user()->id == $requested_user->id)
            <a href="{{ route('profile.edit') }}">
                <button>Edit Profile</button>
            </a>
            @endif
        </div>
    </div>
</div>