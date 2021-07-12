@props(['center' => false])

<td class="px-5 py-3 {{ $center ? 'text-center' : '' }}">{{ $slot }}</td>