@props(['top' => '-20px', 'left' => 0])
<div class="absolute bottom-0 border border-black bg-white px-2 py-2 text-sm" style="left: {{ $left }}; transform: translateY({{ $top }})" x-show="tooltip">
    <p class="text-gray-800 text-sm font-sans font-normal">
        {{ $slot }}
    </p>
</div>
