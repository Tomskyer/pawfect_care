<x-app-layout>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-12 space-y-6">
        @include('profile.view-partials.profile-info')
        @include('profile.view-partials.services')
        @include('profile.view-partials.dogs')
        @include('profile.view-partials.location')
    </div>
</x-app-layout>