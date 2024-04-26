<!-- Service area for carers-->
@if($requested_user->role == 2)
<div class="flex flex-col p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <h1 class="text-3xl text-semibold p-2">{{ $requested_user->name }}'s Services</h1>
    @if($users_services != null)
    @foreach($users_services as $user_service)
    <div class="w-full flex flex-row justify-between sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="flex flex-row justify-between w-full">
            @foreach($services as $service)
            @if($service->id == $user_service->service_id)
            <h1>Dog {{ $service->name }}</h1>
            @endif
            @endforeach
            <h1 class="font-bold">£{{ $user_service->price }} per hour</h1>
        </div>
        @if(Auth::user()->id == $requested_user->id)
        <form method="POST" action="{{ route('service.delete') }}">
            @csrf
            @method('delete')

            <input name="id" value="{{ $user_service->id }}" hidden />
            <x-danger-button class="ms-4">
                Delete
            </x-danger-button>
        </form>
        @endif
    </div>
    @endforeach
    @else
    <p>please add services</p>
    @endif
    @if(Auth::user()->id == $requested_user->id)
    @if(count($users_services) < 4) <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{ route('service.store') }}">
            @csrf

            <input name="user_id" value="{{ Auth::user()->id }}" hidden />
            <div class="mt-4">
                <x-input-label for="service" :value="__('Service')" />
                <select name="service_id" id="service" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <x-input-label for="price" :value="__('Hourly Charge (£)')" />
                <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    add service
                </x-primary-button>
            </div>
        </form>
</div>
@else
<div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
    <h1>Service limit reached</h1>
</div>
@endif
@endif
</div>
@endif