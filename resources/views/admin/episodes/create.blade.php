<x-layouts.admin>
    <x-title borderColor="border-gray-800">Ajouter épisode</x-title>
    
    <form method="POST" action={{ route('admin.animes.episodes.store', $anime_id) }}>
        @csrf
        <div class="flex flex-wrap gap-x-8">
            <x-form.number name="episode_number" text="Numéro de l'épisode" max="10000"/>
            <x-form.number name="season_number" text="Numéro de la saison (vide si pas de saison)" max="100"/>
        </div>
        <x-form.error error="fullname" />
        <x-form.basic-input name="adn" text="ADN" value="https://animedigitalnetwork.fr/video|"/>

        <x-form.basic-input name="crunchyroll" text="Crunchyroll" value="https://www.crunchyroll.com/affiliate_iframeplayer|"/>
        
        <x-form.basic-input name="wakanim" text="Wakanim" value="https://www.wakanim.tv/fr/v2/catalogue/embeddedplayer|"/>
        

        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>