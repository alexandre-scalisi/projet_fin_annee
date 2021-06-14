<x-app-layout>

    <div class="anime-card__container">
        @foreach ($animes as $anime)
        <div class="anime-card">
            <a href="{{ route('animes.show', $anime->id) }}" class="overflow-hidden block">
                <img src="{{ $anime->image }}" class="anime-card__image"></img>
                
            </a>
            <div class="px-4 py-3 g-1">
                <a href="{{ route('animes.show', $anime->id) }}" class="anime-card__title">{{ $anime->title }}</a>
                <p class="anime-card__date"><span>{{ Carbon\Carbon::createFromTimestamp( $anime->release_date)->format('Y')}} -
                    </span>
                    <span>{{ count($anime->episodes) }} épisodes</span>
                </p>
            </div>
        </div>


        @endforeach
    </div>
    {{ $animes->links() }}
</x-app-layout>
