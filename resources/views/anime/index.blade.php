<x-app-layout>
    <div class="anime-card__container">
        @foreach ($animes as $anime)
        <div class="anime-card">
            <a href="{{ route('animes.show', $anime->id) }}" class="overflow-hidden block">
                <img src="{{ h_find_image($anime->image) }}" class="anime-card__image w-full"></img>

            </a>
            <div class="px-4 py-3 g-1">
                <a href="{{ route('animes.show', $anime->id) }}" class="anime-card__title">{{ $anime->title }}</a>
                <p class="anime-card__date">
                    <div class="flex">
                        <div>{{ Carbon\Carbon::parse( $anime->release_date)->format('Y')}} -
                        </div>
                        <div>{{ count($anime->episodes) }} épisodes</div>
                        <div class="ml-auto" style="font-size: 0">                         
                            <x-stars :animeId="$anime->id" textSize="text-xl" color="text-yellow-300"/>
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
