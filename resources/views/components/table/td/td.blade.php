@props(['center' => false, 'th' => ''])

<td class="px-5 py-3 {{ $center ? 'text-center' : '' }} break-words" data-th="{{ $th }}">{{ $slot }}</td>