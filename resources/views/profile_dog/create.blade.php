<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1 class="text-3xl items-center text-semibold">Create a profile for your dog</h1>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('register-dog') }}" enctype="multipart/form-data">
                @csrf

                <!-- Picture -->
                <div class="flex items-center" x-data="picturePreview()">
                    <div class="rounded-md bg-gray-200 mr-2">
                        <img id="preview" src="{{ asset('dog_pictures/default-dog-avatar.webp') }}" alt="" class="w-24 h-24 rounded-md object-cover">
                    </div>
                    <div>
                        <x-secondary-button @click="document.getElementById('picture').click()" class="relative">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                                Upload Picture
                            </div>
                            <input @change="showPreview(event)" type="file" name="picture" id="picture" class="absolute inset-0 -z-10 opacity-0">
                        </x-secondary-button>
                    </div>
                    <script>
                        function picturePreview() {
                            return {
                                showPreview: (event) => {
                                    if (event.target.files.length > 0) {
                                        var src = URL.createObjectURL(event.target.files[0]);
                                        document.getElementById('preview').src = src;
                                    }
                                }
                            }
                        }
                    </script>
                </div>

                <!-- Owner ID -->

                <input name="owner_id" value="{{ Auth::user()->id }}" hidden />

                <div class="flex flex-row justify-between">
                    <!-- Name -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Gender selection -->
                    <div class="block rounded-md mt-8 p-2 hover:bg-gray-200">
                        <input type="radio" id="male" name="gender" value="male" checked>
                        <label for="male">Male</label><br>
                    </div>
                    <div class="block rounded-md mt-8 p-2 hover:bg-gray-200">
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Female</label><br>
                    </div>
                </div>

                <div class="flex flex-row justify-between">
                    <!-- Birthdate -->
                    <div class="mt-4">
                        <x-input-label for="birthdate" :value="__('Birthdate')" />
                        <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required />
                        <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                    </div>

                    <!-- Size -->
                    <div class="mt-4">
                        <x-input-label for="size" :value="__('Size (kg)')" />
                        <x-text-input id="size" class="block mt-1 w-full" type="text" name="size" :value="old('size')" required />
                        <x-input-error :messages="$errors->get('size')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-input-label for="breed" :value="__('Breed')" />
                    <x-dog-breeds></x-dog-breeds>
                </div>

                <!-- About -->
                <div class="mt-4">
                    <x-input-label for="about" :value="__('About (optional)')" />
                    <textarea id="about" class="block mt-1 w-full h-40 rounded-md border-gray-300" type="text" name="about"></textarea>
                    <x-input-error :messages="$errors->get('about')" class="mt-2" />
                </div>

                <!-- Neutered boolean -->
                <div class="mt-4 flex flex-row">
                    <input id="neutered" class="block mt-1 rounded-md" type="checkbox" name="neutered" value="true" />
                    <label for="neutered">Neutered</label>
                    <x-input-error :messages="$errors->get('neutered')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Add Dog Profile') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>