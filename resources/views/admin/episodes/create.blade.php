<x-layouts.admin>
    <h1>Ajouter Episode</h1>
    
    <form method="POST" action={{ route('admin.animes.episodes.store', $anime_id) }} enctype="multipart/form-data">
        @csrf
        <div class="block mb-4">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title">
        </div>
        
        <div class="text-red-500">
            @error('title')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <label for="adn">ADN</label>
            <input type="text" name="adn" id="adn">
        </div>
        
        <div class="text-red-500">
            @error('adn')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <label for="crunchyroll">Crunchyroll</label>
            <input type="text" name="crunchyroll" id="crunchyroll">
        </div>
        
        <div class="text-red-500">
            @error('crunchyroll')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <label for="wakanim">Wakanim</label>
            <input type="text" name="wakanim" id="wakanim">
        </div>
        
        <div class="text-red-500">
            @error('wakanim')
            {{ $message }}
            @enderror
        </div>


        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>