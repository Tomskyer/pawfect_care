<nav class="bg-white max-w-5xl mx-auto sm:px-6 lg:px-8 flex justify-between h-20 items-center">
    <a href="{{ route('home') }}">
        <x-application-logo />
    </a>
    <div class="mr-2">
        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition ease-in-out duration-150">Login</a>
    </div>
</nav>
