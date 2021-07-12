@props(['error' => null])
<div class="block mb-4">
    {{ $slot }}
    <x-form.error :error="$error" />
</div>