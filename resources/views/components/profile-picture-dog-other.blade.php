@props(['picture', 'class'])

@if($picture != null)
<img src="{{ asset($picture) }}" alt="" class="{{ $class }}">
@else
<img src="{{ url('/dog_pictures/default-dog-avatar.webp') }}" alt="" class="{{ $class }}">
@endif