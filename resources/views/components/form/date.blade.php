@props(['error' => $name, 'name', 'min' => '2020-01-01', 'max' => '2100-01-01', 'text'])

<x-form.container :error="$error"> 
    <label for="{{ $name }}" class="block">{{ $text }}</label>
    <input type="date" name="{{ $name }}" id="{{ $name }}" min="{{ $min }}" max="{{ $max }}"></input>
</x-form.container>