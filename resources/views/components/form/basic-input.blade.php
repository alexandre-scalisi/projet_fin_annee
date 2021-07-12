
@props(['error' => $name, 'type' => 'text', 'name', 'text'])

<x-form.container :error="$error"> 
    <label for="{{ $name }}" class="block">{{ $text }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}">
</x-form.container>