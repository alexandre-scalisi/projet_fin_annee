@props(['default' => null])

<th>
    <a href="{{ h_sort_table($sortBy, $default) }}" class="px-5 py-2 inline-block w-full">{{ $slot }} <i
            class="{{ h_sortArrow($sortBy) }}"></i>
    </a>
</th>
