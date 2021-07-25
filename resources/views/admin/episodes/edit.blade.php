<x-layouts.admin>
    <x-title borderColor="border-gray-800">Modifier {{ $episode->title }}</x-title>
    
    <form method="POST" action={{ route('admin.animes.episodes.update', [$episode->anime->id, $episode->id]) }}">
        @csrf
        @method('PUT')
        <div class="flex flex-wrap gap-x-8">
            <x-form.number name="episode_number" text="Numéro de l'épisode" max="10000" value="{{ $episode_number }}"/>
            <x-form.number name="season_number" text="Numéro de la saison (vide si pas de saison)" max="100" value="{{ $episode_season }}" />
        </div>
        <x-form.error error="fullname" />
        <x-form.basic-input name="adn" text="ADN" value="{!! $episode->adn !!}"/>

        <x-form.basic-input name="crunchyroll" text="Crunchyroll" value="{!! $episode->crunchyroll !!}"/>
        
        <x-form.basic-input name="wakanim" text="Wakanim" value="{!! $episode->wakanim !!}"/>
        

        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>