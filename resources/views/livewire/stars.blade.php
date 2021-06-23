{{-- TODO FAUT IMPERATIVEMENT RENDRE CA PLUS PROPRE LOOL --}}
<div x-data="{show: 'first'}" @mouseenter="show = 'second'" @mouseleave="show = 'first'" style="font-size: 0">
    <div x-show="show == 'first'">

        @php $i = 1 @endphp

        @for ($j = 0; $j < $stars_infos['full_stars']; $i++, $j++) 
            <button type="button" wire:click='vote({{ $i }})'
            class="text-xl fas fa-star text-red-600"></button>
        @endfor

        @for ($j = 0;$j < $stars_infos['half_stars']; $i++, $j++) 
            <button type="button" wire:click='vote({{ $i }})'
            class="text-xl fas fa-star-half-alt text-red-600"></button>
        @endfor

        @for ($j = 0;$j < $stars_infos['empty_stars'] ; $i++, $j++) 
            <button type="button" wire:click='vote({{ $i }})'
            class="text-xl far fa-star text-red-600"></button>
        @endfor
                    
        <p class="inline-block ml-2 text-xl">{{ $stars_infos['votes_avg'] }} / 5 <small class="text-xs">({{ $stars_infos['votes_count'] }} votants)</small></p>

    </div>

    <div x-show="show == 'second'">
        @if($user_vote != 'Pas de vote')
        <div x-data="{val: {{ $user_vote }} }" x-bind:value="{{ $user_vote }}">
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

</div>
