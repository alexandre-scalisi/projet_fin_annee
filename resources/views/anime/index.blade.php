<x-app-layout>
    <div class="anime-card__container">
        @foreach ($animes as $anime)
        <div class="anime-card">
            <a href="{{ route('animes.show', $anime->id) }}" class="overflow-hidden block">
                <img src="{{ $anime->image }}" class="anime-card__image"></img>

            </a>
            <div class="px-4 py-3 g-1">
                <a href="{{ route('animes.show', $anime->id) }}" class="anime-card__title">{{ $anime->title }}</a>
                <p class="anime-card__date">
                    <div class="flex">
                        <div>{{ Carbon\Carbon::createFromTimestamp( $anime->release_date)->format('Y')}} -
                        </div>
                        <div>{{ count($anime->episodes) }} épisodes</div>
                        <div class="ml-auto" style="font-size: 0">                         
                            @php            
                                $full_vote = $anime->votes->avg('vote') ?? 0;
                                $full_stars = (int) $full_vote;
                                $half_stars = $full_vote - $full_stars > .5 ? 1 : 0;
                                $empty_stars = 5 - $full_stars - $half_stars;   
                            @endphp
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
                    </div>
                </p>
            </div>
        </div>


        @endforeach
    </div>
    {{ $animes->links() }}
</x-app-layout>
