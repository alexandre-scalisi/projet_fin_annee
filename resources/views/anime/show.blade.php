<x-app-layout>
<div class="max-w-4xl">
@php
    $last_episode_id = $anime->episodes->pluck('id')->toArray()[count($anime->episodes) - 1];

    @endphp

    <div class="anime-header">
        <div class="anime__image" style="background-image: url({{ h_find_image($anime->image) }})">
            <a href="#"
                class="inline-block m-3 h-12 w-12 transition duration-500 bg-white rounded-full hover:bg-gray-200 bg-opacity-75">
                <svg class="w-full h-full fill-current text-gray-900 p-2" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M18 24l-6-5.269-6 5.269v-24h12v24z" /></svg>

            </a>

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
                <li class="anime__info"><span class="anime__info_big">Episodes :</span>
                    {{ count($anime->episodes) }}</li>
                @livewire('stars', compact('anime'))
            </ul>
            
            <div class="mt-6 flex items-center">
                <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $anime->episodes->first()->id] ) }}"
                    class="anime__btn anime__btn_first">Premier EP</a>
                <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $last_episode_id] ) }}"
                    class="anime__btn">Dernier EP</a>                    
                   
                <a href="#" class="anime__comment-link">0 commentaires</a>
            </div>
            {{-- TODO Rajouter votes --}}
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
                @foreach ($episodes as $episode)
                <li>
                    <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $episode->id] ) }}"
                        class="anime-episodes__item">{{ $episode->title }}</a>
                </li>
                @endforeach
            </ul>
            {{ $episodes->links() }}
        </div>
    </div>
    <!-- TODO gerer la pagination -->
    @livewire('form-container', ['type_id' => $anime->id, 'type' => 'Anime'])
</div>
</x-app-layout>
