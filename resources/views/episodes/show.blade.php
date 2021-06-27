<x-app-layout>
    {{-- TODO voir le probleme avec turbolink --}}
    <h1 class="text-2xl font-bold border-b-4 border-indigo-700 mb-8">{{ $episode->title }}</h1>
    @if(!empty($links))
    @if(key_exists('adn', $links)) @php $links['adn'] = str_replace('video', 'embedded', $links['adn']) @endphp @endif
    <div x-data="{selec: '{{ reset($links) }}' }">
        {{-- TODO FAIRE CA BEAUCOUP PLUS PROPREMENT PUTAIN --}}
        <select x-model="selec">
            @foreach($links as $l => $link)

            <option value="{{ $link }}">{{ $l }}</option>
            @endforeach
        </select>

        <iframe x-bind:src="selec" style="width: 100%; height: 53vw; max-height: 700px" scrolling="no" frameborder="0"
            allowfullscreen="true" webkitallowfullscreen="true" allowScriptAccess="always"
            mozallowfullscreen="true"></iframe>
        @endif
    
        @livewire('form-container', ['type_id' => $episode->id, 'type' => 'Episode'])
    </div>
    
    {{--TODO avec livewire créer 2 fonctions ( 1 pour les boutons level 1 et l'autre pour les boutons level 2 avec en parametre le commentable_id)  --}}
</x-app-layout>
