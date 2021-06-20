<div x-data="{show: 'first'}" @mouseenter="show = 'second'" @mouseleave="show = 'first'" style="font-size: 0">
    <div x-show="show == 'first'">

        @php $i = 1 @endphp

        @for ($j = 0; $j < $full_stars; $i++, $j++) <button type="button" wire:click='vote({{ $i }})'
            class="text-xl fas fa-star text-red-600"></button>
            @endfor
            @for ($j = 0;$j < $half_stars; $i++, $j++) <button type="button" wire:click='vote({{ $i }})'
                class="text-xl fas fa-star-half-alt text-red-600"></button>
                @endfor
                @for ($j = 0;$j < $empty_stars; $i++, $j++) <button type="button" wire:click='vote({{ $i }})'
                    class="text-xl far fa-star text-red-600"></button>
                    @endfor
                    <p class="inline-block ml-2 text-xl">{{ $avg }} / 5</p>

    </div>
    <div x-show="show == 'second'">
        @php $v = 1 @endphp
        <div x-data="{val: {{ $user_vote }} }" x-bind:value="{{ $user_vote }}">
            <span x-on:mouseout="val= $el.value">
            @for($j = 1; $j <= 5; $j++) 
                <button type="button" wire:click='vote({{ $j }})' x-on:mouseenter="val={{ $j }}"
                class="text-xl text-red-600" :class="{{ $j }} <= val ? 'fas fa-star' : 'far fa-star'"></button>

            @endfor
            </span>
            <p class="inline-block ml-2 text-xl">Votre note</p>
        </div>
    </div>

</div>
