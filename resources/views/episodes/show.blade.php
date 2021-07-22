<x-app-layout>


    <h1 class="text-2xl font-bold border-b-4 border-indigo-700 mb-4">{{ $episode->title }}</h1>

    <a href="{{ route('animes.show', $episode->anime->id) }}"
        class="bg-blue-500 px-3 py-1 mb-4 inline-block text-blue-50">Retour</a>
    @if(!empty($links))
    @if(key_exists('adn', $links)) @php $links['adn'] = str_replace('video', 'embedded', $links['adn']) @endphp @endif
    <div x-data="{selec: '{{ reset($links) }}' }">
        <div class="flex flex-wrap gap-x-12 gap-y-3">
            <select x-model="selec" class="max-w-full">
                @foreach($links as $l => $link)

                <option value="{{ $link }}">{{ $l }}</option>
                @endforeach
            </select>

            <select onchange="location = this.value" class="max-w-full">
                @foreach($episodes as $ep)
                <option {{ $ep->id === $episode->id ? 'selected' : ''}}
                    value="{{ route('animes.episodes.show', ['anime' => $ep->anime->id, 'episode' => $ep->id]) }}">
                    {{ $ep->title }}</option>
                @endforeach
            </select>
        </div>
        <div style="width: 100%; height: 53vw; max-height: 700px" class="relative bg-white">
            <div class="absolute top-0 left-0 right-0 bottom-0 flex justify-center items-center flex-col gap-y-2">
                <p class="fa fa-3x fa-spinner animate-spin"></p>
                <p>Veuillez patientez</p>
            </div>
            <iframe x-bind:src="selec" class="w-full h-full relative z-50" scrolling="no" frameborder="0"
                allowfullscreen="true" webkitallowfullscreen="true" allowScriptAccess="always"
                mozallowfullscreen="true"></iframe>
            @endif
        </div>
        <div class="flex flex-wrap my-2">
            @if($prev)
            <a href="{{ route('animes.episodes.show', ['anime' => $episode->anime->id, 'episode' => $prev]) }}"
                class="bg-blue-700 px-4 py-1 rounded-full text-blue-50">Précedent</a>
            @endif
            @if($next)
            <a href="{{ route('animes.episodes.show', ['anime' => $episode->anime->id, 'episode' => $next]) }}"
                class="ml-auto bg-blue-700 px-4 py-1 rounded-full text-blue-50">Suivant</a>

            @endif
        </div>
        @livewire('form-container', ['type_id' => $episode->id, 'type' => 'Episode'])
    </div>
</x-app-layout>
