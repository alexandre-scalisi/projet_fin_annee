@props(['error' => $name, 'min' => 0, 'max' => 1000, 'name', 'text', 'value' => ""])

<x-form.container :error="$error"> 
    <label for="{{ $name }}" class="block">{{ $text }}</label>
    <input type="number" name="{{ $name }}" id="{{ $name }}" min="{{ $min }}" max="{{ $max }}" value="{{ $value }}">
</x-form.container>