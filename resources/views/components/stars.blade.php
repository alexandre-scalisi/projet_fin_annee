<div>
    @for ($i = 0; $i<$full_stars; $i++)
        <span class="fas fa-star text-xl"></span>
    @endfor
    @for ($i = 0; $i<$half_stars; $i++)
        <span class="fas fa-star-half-alt text-xl"></span>
    @endfor
    @for ($i = 0; $i<$empty_stars; $i++)
        <span class="far fa-star text-xl"></span>
    @endfor
        <p class="text-lg">{{ $anime->votes->count() }} votes</p>
</div>