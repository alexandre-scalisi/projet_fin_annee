<x-app-layout>
    @php
    Carbon\Carbon::setlocale(config('app.locale'));
    $last_episode_id = $anime->episodes->pluck('id')->toArray()[count($anime->episodes) - 1];

    @endphp
    <div class="flex text-gray-100 bg-gray-800 rounded-md overflow-hidden">
        <div class="w-full max-w-lg xl:max-w-xl h-80 bg-cover bg-center"
            style="background-image: url({{ $anime->image }})">
            <a href="#"
                class="inline-block m-3 h-12 w-12 transition duration-500 bg-white rounded-full hover:bg-gray-200 bg-opacity-75">
                <svg class="w-full h-full fill-current text-gray-900 p-2" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M18 24l-6-5.269-6 5.269v-24h12v24z" /></svg>

            </a>
        </div>

        <div class="px-6 py-4 w-full">
            <div class="flex justify-between">
                <h1 class="text-4xl mb-4">{{ $anime->title }}</h1>
                {{-- TODO Rajouter tooltip et lien vers favoris --}}

            </div>
            <p class="mb-3 text-gray-300"><span class="font-weight-bolder text-xl mr-2 text-gray-100">Date de sortie
                    :</span> {{ Carbon\Carbon::createFromTimestamp( $anime->release_date)->translatedFormat('d F Y') }}
            </p>
            <p class="mb-3 text-gray-300"><span class="font-weight-bolder text-xl mr-2 text-gray-100">Studio :</span>
                {{ $anime->studio }}</p>
            <p class="mb-3 text-gray-300"><span class="font-weight-bolder text-xl mr-2 text-gray-100">Genres :</span>
                {{ implode(', ', $anime->genres->pluck('name')->toArray()) }}</p>
            <p class="mb-3 text-gray-300"><span class="font-weight-bolder text-xl mr-2 text-gray-100">Episodes :</span>
                {{ count($anime->episodes) }}</p>
            <div class="mt-6 flex items-center">
                <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $anime->episodes->first()->id] ) }}"
                    class="text-gray-100 border border-yellow-400 rounded-xl px-4 py-2 mr-3">Premier EP</a>
                <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $last_episode_id] ) }}"
                    class="text-gray-100 border border-yellow-400 rounded-xl px-4 py-2">Dernier EP</a>
                <a href="#" class="text-gray-100 ml-auto">0 commentaires</a>
            </div>
            {{-- TODO Rajouter votes --}}
        </div>

    </div>

    <div x-data="{truncated: true }" class="bg-gray-200 px-8 py-4 mt-3 rounded-md">
        <h2 class="text-3xl mb-4">Synopsis</h2>
        <p class="text-lg mb-3" x-show="truncated"> {{ $truncated_synopsis }} </p>
        <p class="text-lg mb-3" x-show="!truncated"> {{ $anime->synopsis }} </p>
        @if($anime->synopsis !== $truncated_synopsis)
        <btn class="bg-blue-600 text-gray-100 px-3 py-1 text-sm cursor-pointer" @click="truncated = !truncated"
            x-text="truncated ? 'Afficher plus' : 'Afficher moins'"></btn>
        @endif
    </div>
    <div class="bg-white p-8 mt-3 rounded-md">
        <h2 class="text-3xl mb-4">
            Liste des épisodes
        </h2>
        <div class="flex flex-col flex-wrap items-start">
            <ul>
            @foreach ($episodes as $episode)
                <li>
                    <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $episode->id] ) }}"
                        class="text-lg text-blue-600 inline-block mb-2"
                        >{{ $episode->title }}</a>
                </li>
            @endforeach
            </ul>
            {{ $episodes->links() }}
        </div>
    </div>
    <!-- TODO gerer la pagination -->

</x-app-layout>
