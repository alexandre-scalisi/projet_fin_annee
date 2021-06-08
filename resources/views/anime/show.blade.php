<x-app-layout>
    @php 
        Carbon\Carbon::setlocale(config('app.locale'));
        $last_episode_id = $anime->episodes->pluck('id')->toArray()[count($anime->episodes) - 1];
        
    @endphp
    <div class="flex text-gray-100 bg-gray-800">
        <img src="{{ $anime->image }}" alt="" class="max-w-lg xl:max-w-xl h-80 object-cover">
        <div class="px-6 py-4 w-full"> 
            <div class="flex justify-between">
                <h1 class="text-5xl mb-4">{{ $anime->title }}</h1>
                {{-- TODO Rajouter tooltip et lien vers favoris --}}
                <a href="#"class="h-12 w-12 transition duration-500 bg-white rounded-full hover:bg-gray-200">
                    <svg class="w-full h-full fill-current text-gray-900 p-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18 24l-6-5.269-6 5.269v-24h12v24z"/></svg>
                    
                </a>
            </div>
            <p class="mb-3 text-gray-300"><span class="font-weight-bolder text-xl mr-2 text-gray-100">Date de sortie :</span> {{ Carbon\Carbon::createFromTimestamp( $anime->release_date)->translatedFormat('d F Y') }}</p>
            <p class="mb-3 text-gray-300"><span class="font-weight-bolder text-xl mr-2 text-gray-100">Studio :</span> {{ $anime->studio }}</p>
            <p class="mb-3 text-gray-300"><span class="font-weight-bolder text-xl mr-2 text-gray-100">Genres :</span> {{ implode(', ', $anime->genres->pluck('name')->toArray()) }}</p>
            <p class="mb-3 text-gray-300"><span class="font-weight-bolder text-xl mr-2 text-gray-100">Episodes :</span> {{ count($anime->episodes) }}</p>
            <div class="mt-6 flex items-center">
                <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $anime->episodes->first()->id] ) }}" class="text-gray-100 border border-yellow-400 rounded-xl px-4 py-2 mr-3">Premier EP</a>
                <a href="{{ route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $last_episode_id] ) }}" class="text-gray-100 border border-yellow-400 rounded-xl px-4 py-2">Dernier EP</a>
                <a href="#" class="text-gray-100 ml-auto">0 commentaires</a>
            </div>
            {{-- TODO Rajouter votes --}}

        </div>
        
    </div>
</x-app-layout>
