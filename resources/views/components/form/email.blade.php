@props(['error' => $name, 'name', 'text'])

<x-form.container :error="$error"> 
    <label for="{{ $name }}" class="block">{{ $text }}</label>
    <input type="email" name="{{ $name }}" id="{{ $name }}">
</x-form.container>