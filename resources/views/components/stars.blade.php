<div>
    @for ($i = 0; $i<$stars_infos['full_stars']; $i++)
        <span class="fas fa-star {{ $text_size }} {{ $color }}"></span>
    @endfor
    @for ($i = 0; $i<$stars_infos['half_stars']; $i++)
        <span class="fas fa-star-half-alt {{ $text_size }} {{ $color }}"></span>
    @endfor
    @for ($i = 0; $i<$stars_infos['empty_stars']; $i++)
        <span class="far fa-star {{ $text_size }} {{ $color }}"></span>
    @endfor
        
</div>