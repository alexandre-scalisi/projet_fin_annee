{{-- TODO FAUT IMPERATIVEMENT RENDRE CA PLUS PROPRE LOOL --}}
<div x-data="{show: 'first'}" @auth @mouseenter="show = 'second'" @mouseleave="show = 'first'" @endauth style="font-size: 0">
    <div x-show="show == 'first'" class="flex flex-wrap gap-x-3 gap-y-2">

        @php $i = 1 @endphp
        <div>
        @for ($j = 0; $j < $stars_infos['full_stars']; $i++, $j++) 
            <button type="button" @auth wire:click='vote({{ $i }})'@endauth
            class="text-xl fas fa-star text-red-600 @guest cursor-default @endguest"></button>
        @endfor

        @for ($j = 0;$j < $stars_infos['half_stars']; $i++, $j++) 
            <button type="button" @auth wire:click='vote({{ $i }})'@endauth
            class="text-xl fas fa-star-half-alt text-red-600 @guest cursor-default @endguest"></button>
        @endfor

        @for ($j = 0;$j < $stars_infos['empty_stars'] ; $i++, $j++) 
            <button type="button" @auth wire:click='vote({{ $i }})'@endauth
            class="text-xl far fa-star text-red-600 @guest cursor-default @endguest"></button>
        @endfor
        </div>      
        <p class="text-xl -mt-0.5">{{ $stars_infos['votes_avg'] }} / 5 <small class="text-xs">({{ $stars_infos['votes_count'] }} votants)</small></p>

    </div>

    @auth
    <div x-show="show == 'second'">
        @if($user_vote != 'Pas de vote')
        <div x-data="{val: {{ $user_vote }} }" x-bind:value="{{ $user_vote }}" class="flex flex-wrap gap-x-3 gap-y-2">
            <span x-on:mouseout="val= $el.value">
            @for($j = 1; $j <= 5; $j++) 
                <button type="button" wire:click='vote({{ $j }})' x-on:mouseenter="val={{ $j }}"
                class="text-xl text-red-600" :class="{{ $j }} <= val ? 'fas fa-star' : 'far fa-star'"></button>

            @endfor
            </span>
            <p class="inline-block ml-2 text-xl">Votre note : {{ $user_vote }} / 5</p>
        </div>
        @else
        <div x-data="{val: 0}">
            <span x-on:mouseout="val = 0">
            @for($j = 1; $j <= 5; $j++) 
                <button type="button" wire:click='vote({{ $j }})' x-on:mouseenter="val={{ $j }}"
                class="text-xl text-red-600" :class="{{ $j }} <= val ? 'fas fa-star' : 'far fa-star'"></button>

            @endfor
            </span>
            <p class="inline-block ml-2 text-xl">Pas de vote</p>
        </div>
        @endif
    </div>
    @endauth
</div>
