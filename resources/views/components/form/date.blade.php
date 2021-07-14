@props(['error' => $name, 'value' => '', 'name', 'min' => '1950-01-01', 'max' => '2100-01-01', 'text'])

<x-form.container :error="$error"> 
    <label for="{{ $name }}" class="block">{{ $text }}</label>
    <input type="date" name="{{ $name }}" id="{{ $name }}" min="{{ $min }}" max="{{ $max }}" value="{{ $value }}"></input>
</x-form.container>