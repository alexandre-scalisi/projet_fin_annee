@props(['error' => $name, 'content' => '', 'name', 'text'])

<x-form.container :error="$error"> 
    <label for="{{ $name }}" class="block">{{ $text }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}">{{ $slot }}</textarea>
</x-form.container>