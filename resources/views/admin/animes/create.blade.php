<x-layouts.admin>
    <h1>Ajouter Anime</h1>
    
    <form method="POST" action={{ route('admin.animes.store') }} enctype="multipart/form-data">
        @csrf
        <div class="block mb-4">
        <label for="title">titre</label>
        <input type="text" name="title" id="title">
        
        </div>
        
        <div class="text-red-500">
        @error('title')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
        <label for="synopsis">synopsis</label>
        <textarea name="synopsis" id="synopsis"></textarea>
        </div>
        <div class="text-red-500">
        @error('synopsis')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <label for="release_date">release_date</label>
            <input type="date" name="release_date" id="release_date">
        </div>
        <div class="text-red-500">
        @error('release_date')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <label for="studio">studio</label>
            <input type="text" name="studio" id="studio">
        </div>
        <div class="text-red-500"> 
        @error('studio')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <input type="file" name="image" accept="image/*" id="image-input">
            <div class="w-48 h-28 relative hidden" id="preview-box">
                <button x-data="" @click.prevent="deleteImage()" class="absolute right-4 z-50 text-red-600 text-2xl" style="text-shadow: 1px 1px 2px black;">&times;</button>
                <img id="image" class="w-full h-full">
            </div>
            <p class="text-red-500 hidden" id="invalid-msg">Format invalide, formats autorisés: jpg, jpeg, png</p>
            @error('image')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <x-genre-modal />
            @error('genre.*')
            {{ $message }}
            @enderror
            @error('genre')
            {{ $message }}
            @enderror
        </div>
        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>