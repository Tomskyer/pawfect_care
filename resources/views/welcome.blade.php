<x-guest-layout>
    <x-banner header="Pawfect Care" desc="Connecting Dog Owners and Carers"></x-banner>
    <a href='{{ url("/register/1") }}'>
        <button>
            I'm an owner
        </button>
    </a>

    <a href='{{ url("/register/2") }}'>
        <button>
            I'm a carer
        </button>
    </a>
</x-guest-layout>