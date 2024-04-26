<x-app-layout>
    <x-banner header="Pawfect Care" desc="Connecting Dog Owners with Carers"></x-banner>
    <div class="flex items-center flex-col justify-between max-w-4xl mx-auto m-10">
        <h1 class="text-4xl font-semibold">Register with us today!</h1>
    </div>
    <div class="flex sm:flex-row items-center flex-col justify-between max-w-4xl mx-auto m-10 ">
        <div class="flex flex-col items-center mt-4 px-6">
            <img src="{{ asset('images/owner.png') }}" alt="" />
            <a href='{{ url("/register/1") }}'>
                <button class="inline-flex items-center mt-4 px-4 py-3 bg-green-500 border border-transparent rounded-md font-semibold text-s text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition ease-in-out duration-150">
                    I'm an owner
                </button>
            </a>
        </div>
        <div class="flex flex-col items-center mt-4 px-6">
            <img src="{{ asset('images/carer.png') }}" alt="" />
            <a href='{{ url("/register/2") }}'>
                <button class="inline-flex items-center mt-4 px-4 py-3 bg-green-500 border border-transparent rounded-md font-semibold text-s text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition ease-in-out duration-150">
                    I'm a carer
                </button>
            </a>
        </div>

    </div>
</x-app-layout>