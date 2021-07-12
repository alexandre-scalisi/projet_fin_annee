@props(['error' => $name, 'name', 'text'])

<x-form.container :error="$error"> 
    <label for="{{ $name }}" class="block">{{ $text }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}"></textarea>
</x-form.container>