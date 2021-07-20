<x-app-layout>
    <div class="-mx-4 sm:mx-0">
    <h1 class="text-2xl font-bold border-b-4 border-indigo-700 mb-8 mx-2 sm:mx-0">{{ $type }}</h1>
    <div class="anime-card__container">
        @foreach ($animes as $anime)
        <div class="anime-card">
            <a href="{{ route('animes.show', $anime->id) }}" class="overflow-hidden block">
                <img src="{{ h_find_image($anime->image) }}" class="anime-card__image w-full"></img>
            </a>
            <div class="px-4 py-3 g-1">
                <a href="{{ route('animes.show', $anime->id) }}" class="anime-card__title">{{ $anime->title }}</a>
                <p class="anime-card__date">
                    <div class="flex flex-wrap gap-y-2 gap-x-4">
                        <p>{{ Carbon\Carbon::parse( $anime->release_date)->format('Y')}} - {{ count($anime->episodes) }} épisodes </p>
                        <div class="sm:ml-auto" style="font-size: 0">                         
                            <x-stars :animeId="$anime->id" textSize="text-xl" color="text-yellow-300"/>
                        </div>
                    </div>
                </p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mx-2">
    {{ $animes->links() }}
    </div>
</div>
</x-app-layout>
