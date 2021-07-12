<x-layouts.admin>
    <h1>Ajouter Episode</h1>
    
    <form method="POST" action={{ route('admin.animes.episodes.store', $anime_id) }} enctype="multipart/form-data">
        @csrf
        <div class="flex flex-wrap gap-x-8">
            <x-form.number name="episode_number" text="Numéro de l'épisode" max="10000"/>
            <x-form.number name="season_number" text="Numéro de la saison (vide si pas de saison)" max="100"/>
        </div>
        
        <x-form.text name="adn" text="ADN"/>

        <x-form.text name="crunchyroll" text="Crunchyroll"/>
        
        <x-form.text name="wakanim" text="Wakanim"/>


        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>