@props(['banner', 'header', 'desc'])

<div class="relative">
    <img class="w-full" src="{{ url('/images/banner3.webp') }}" alt="">
    <div class="absolute inset-0 rounded-md w-full bg-slate-600 opacity-40"></div>
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="flex flex-col items-center">
            <h2 class="text-white sm:text-3xl lg:text-8xl font-bold drop-shadow-2xl [text-shadow:_2px_3px_2px_rgb(0_0_0_/_100%)]">{{ $header }}</h2>
            <h3 class="text-white sm:text-xl lg:text-4xl font-bold drop-shadow-2xl [text-shadow:_2px_3px_2px_rgb(0_0_0_/_100%)]">{{ $desc }}</h3>
        </div>
    </div>
</div>