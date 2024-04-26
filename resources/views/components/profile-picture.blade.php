@props(['user', 'class'])

@if(Auth::user())
@if(Auth::user()->picture != null)
<img id="preview" src="{{ asset(Auth::user()->picture) }}" alt="" class="{{ $class }}">
@else
<img id="preview" src="{{ asset('profile_pictures/default-user-avatar.webp') }}" alt="" class="{{ $class }}">
@endif
@else
<img id="preview" src="{{ asset('profile_pictures/default-user-avatar.webp') }}" alt="" class="{{ $class }}">
@endif