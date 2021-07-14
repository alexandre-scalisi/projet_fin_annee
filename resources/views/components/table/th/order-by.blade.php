@props(['default' => 'asc', 'center' => false])

<th>
    <a href="{{ h_sort_table($sortBy, $default) }}" class="px-5 py-2 inline-block w-full {{ $center ? 'text-center' : '' }}"><i class="fas fa-arrows-alt-v text-sm mr-1 text-gray-700"></i>{{ $slot }} <i
            class="{{ h_sortArrow($sortBy) }}"></i>
    </a>
</th>
