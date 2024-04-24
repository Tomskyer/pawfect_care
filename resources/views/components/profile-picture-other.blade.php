@props(['picture', 'class'])

@if($picture != null)
<img src="{{ asset($picture) }}" alt="" class="{{ $class }}">
@else
<img src="{{ url('/profile_pictures/default-user-avatar.webp') }}" alt="" class="{{ $class }}">
@endif
