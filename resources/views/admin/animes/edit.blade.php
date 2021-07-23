<x-layouts.admin>
    <x-title border-color="border-gray-800">Modifier anime</x-title>
    <form method="POST" action="{{ route('admin.animes.update', $anime->id) }}" enctype="multipart/form-data" x-data="" x-init="window.edit">
        @csrf
        @method('PUT')
        <x-form.basic-input text="Titre" name="title" :value="$anime->title"/>
        <x-form.textarea text="Synopsis" name="synopsis">{{ $anime->synopsis }}</x-form.textarea>
        <x-form.date text="Date de sortie" name="release_date" value="{{ date('Y-m-d', strtotime($anime->release_date)) }}" /> 
        <x-form.basic-input text="Studio" name="studio" :value="$anime->studio" />
        
        <x-form.container error="image">
            <div x-data="{ obj: window.edit() }" x-init="obj.init()">
                <label for="image-input" class="block">Image (16/9 recommandé)</label>
                <input type="file" name="image" accept="image/*" id="image-input">
                <div class="w-48 h-28 relative hidden" id="preview-box">
                    <button @click.prevent="obj.deleteImage()" class="absolute right-4 z-50 text-red-600 text-2xl" style="text-shadow: 1px 1px 2px black;">&times;</button>
                    <img src="{{ h_find_image($anime->image) }}" id="image" class="w-full h-full">
                </div>
                <p class="text-red-500 hidden" id="invalid-msg">Format invalide, formats autorisés: jpg, jpeg, png</p>
            </div>
        </x-form.container>
        
        <x-form.container>
            <x-genre-modal :edit-genres="$edit_genres"/>
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
