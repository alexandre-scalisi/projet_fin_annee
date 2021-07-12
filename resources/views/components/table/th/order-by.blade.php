@props(['default' => null, 'center' => false])

<th>
    <a href="{{ h_sort_table($sortBy, $default) }}" class="px-5 py-2 inline-block w-full {{ $center ? 'text-center' : '' }}">{{ $slot }} <i
            class="{{ h_sortArrow($sortBy) }}"></i>
    </a>
</th>
