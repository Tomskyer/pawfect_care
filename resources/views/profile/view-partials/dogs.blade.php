<!-- Dogs section for owners -->
@if($requested_user->role == 1)
<div class="flex flex-col p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <h1 class="text-3xl text-semibold">Dogs</h1>
    @if(count($dogs) == 0)
    <p>You don't have any dog's on your profile yet. Try adding some.</p>
    @endif
    @foreach($dogs as $dog)
    <a class="w-full flex flex-row justify-between sm:max-w-md mt-6 bg-white hover:bg-gray-200 shadow-md overflow-hidden sm:rounded-lg" href='{{ url("/view-profile-dog/{$dog->id}") }}'>
            <div>
                <div class="flex flex-row">
                    <x-profile-picture-dog-other picture="{{ $dog->picture }}" class="rounded-md w-24 h-24"></x-profile-picture-dog-other>
                    <div class="flex flex-col mx-2">
                        <h1 class="font-bold">{{ $dog->name }}</h1>
                    </div>
                </div>
            </div>
            @if(Auth::user()->id == $requested_user->id)
            <div class="m-8">
                <form method="POST" action="{{ route('profile_dog.destroy') }}">
                    @csrf
                    @method('delete')

                    <input name="id" value="{{ $dog->id }}" hidden />
                    <x-danger-button class="ms-4">
                        Delete
                    </x-danger-button>
                </form>
            </div>
            @endif
    </a>
    @endforeach
    @if(Auth::user()->id == $requested_user->id)
    <div class="mt-4">
        <a href="{{ route('profile_dog.create') }}">
            <x-secondary-button>Create new dog profile</x-secondary-button>
        </a>
    </div>
    @endif
</div>
@endif