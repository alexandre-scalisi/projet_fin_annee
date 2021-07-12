
@props(['error' => null, 'name', 'text'])

<x-form.container :error="$error"> 
    <label for="{{ $name }}" class="block">{{ $text }}</label>
    <input type="text" name="{{ $name }}" id="{{ $name }}">
</x-form.container>