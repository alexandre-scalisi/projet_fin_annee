<div>
        @for ($i = 0; $i < $full_stars; $i++, $star_value++) 
            <button type="button" wire:click='vote({{ $star_value }})' class="fas fa-star text-red-600"></button>
        @endfor
        @for ($i = 0; $i < $half_stars; $i++, $star_value++) 
            <button type="button" wire:click='vote({{ $star_value }})' class="fas fa-star-half-alt text-red-600"></button>
        @endfor
        @for ($i = 0; $i < $empty_stars; $i++, $star_value++) 
            <button type="button" wire:click='vote({{ $star_value }})' class="far fa-star text-red-600"></button>
        @endfor
    <p>{{ $avg }}</p>
</div>
