<x-app-layout>
    <div class="-mx-4 sm:mx-0">

        <div class="anime-header">
            <div class="anime__image" style="background-image: url({{ h_find_image($anime->image) }})">


            </div>

            <div class="anime-header__content-container">
                <div class="anime__title_container">
                    <h1 class="anime__title">{{ $anime->title }}</h1>
                    {{-- TODO Rajouter tooltip et lien vers favoris --}}

                </div>
                <ul>
                    <li class="anime__info"><span class="anime__info_big">Date de sortie
                            :</span> {{ Carbon\Carbon::parse( $anime->release_date)->translatedFormat('d F Y') }}
                    </li>
                    <li class="anime__info"><span class="anime__info_big">Studio :</span>
                        {{ $anime->studio }}</li>
                    <li class="anime__info"><span class="anime__info_big">Genres :</span>
                        {{ implode(', ', $anime->genres->pluck('name')->toArray()) }}</li>
                    <li class="anime__info inline-block mr-12"><span class="anime__info_big">Episodes :</span>
                        {{ count($anime->episodes)}}</li>
                    @livewire('stars', compact('anime'))
                </ul>

                <div class="mt-6 flex items-center flex-wrap gap-y-4 gap-x-2">
                    @if($anime->episodes->count() > 0)
                    <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $anime->episodes->first()->id] ) }}"
                        class="anime__btn anime__btn_first">Premier EP</a>
                    <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $last_episode_id] ) }}"
                        class="anime__btn mr-auto">Dernier EP</a>
                    @endif
                    <div class="flex flex-wrap gap-x-2 gap-y-4">
                        @auth
                            @livewire('follow-button', compact('anime'))
                        @endauth
                        @livewire('comment-count', ['model' => $anime])
                    </div>
                </div>
            </div>

        </div>

        <div x-data="{truncated: true }" class="synopsis">
            <h2 class="synopsis__title">Synopsis</h2>
            <p class="synopsis__text" x-show="truncated"> {{ $truncated_synopsis }} </p>
            <p class="synopsis__text" x-show="!truncated"> {{ $anime->synopsis }} </p>
            @if($anime->synopsis !== $truncated_synopsis)
            <btn class="btn-more" @click="truncated = !truncated"
                x-text="truncated ? 'Afficher plus' : 'Afficher moins'"></btn>
            @endif

        </div>
        <div class="anime-episodes">
            <h2 class="anime-episodes__title">
                Liste des épisodes
            </h2>
            <div class="anime-episodes__list">
                <ul>
                    @forelse ($episodes as $episode)
                    <li>
                        <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $episode->id] ) }}"
                            class="anime-episodes__item">{{ $episode->title }}</a>
                    </li>
                    @empty
                        Pas d'épisodes
                    @endforelse
                </ul>
                {{ $episodes->links() }}
            </div>
        </div>

        @livewire('form-container', ['type_id' => $anime->id, 'type' => 'Anime'])
    </div>
</x-app-layout>
