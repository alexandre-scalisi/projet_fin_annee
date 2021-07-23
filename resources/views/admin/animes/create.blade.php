<x-layouts.admin>
    <x-title borderColor="border-gray-800">Créer Anime</x-title>
    
    <form method="POST" action={{ route('admin.animes.store') }} enctype="multipart/form-data">
        @csrf
        <x-form.basic-input name="title" text="Titre" :value="old('title')"/>
        
        <x-form.textarea name="synopsis" text="Synopsis"> {{ old('title') }}</x-form.textarea>
        
        <x-form.date name="release_date" text="Date de sortie" :value="old('release_date')"/>
        <x-form.basic-input name="studio" text="Studio" :value="old('studio')"/> 
        <x-form.container error="image">
            <div x-data="{ obj: window.edit() }" x-init="obj.init()">
                <label for="image-input" class="block">Image (16/9 recommandé)</label>
                <input type="file" name="image" accept="image/*" id="image-input">
                <div class="w-48 h-28 relative hidden" id="preview-box">
                    <button @click.prevent="obj.deleteImage()" class="absolute right-4 z-50 text-red-600 text-2xl" style="text-shadow: 1px 1px 2px black;">&times;</button>
                    <img id="image" class="w-full h-full">
                </div>
                <p class="text-red-500 hidden" id="invalid-msg">Format invalide, formats autorisés: jpg, jpeg, png</p>
            </div>
        </x-form.container>
        <x-form.container>
            <x-genre-modal />
            @error('genre.*')
            {{ $message }}
            @enderror
            @error('genre')
            {{ $message }}
            @enderror
        </x-form.container>
        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>