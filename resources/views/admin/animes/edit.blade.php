<x-layouts.admin>
    <h1> Anime update </h1>
    <form method="POST" action="{{ route('admin.animes.update', $anime->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="block mb-4">
        <label for="title">titre</label>
        <input type="text" name="title" id="title" value="{{ $anime->title }}">
        
        </div>
        
        <div class="text-red-500">
        @error('title')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
        <label for="synopsis">synopsis</label>
        <textarea name="synopsis" id="synopsis">{{ $anime->synopsis }}</textarea>
        </div>
        <div class="text-red-500">
        @error('synopsis')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <label for="release_date">Date de sortie</label>
            <input type="date" name="release_date" id="release_date" value="{{ date('Y-m-d', strtotime($anime->release_date)) }}">
        </div>
        <div class="text-red-500">
        @error('release_date')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <label for="studio">studio</label>
            <input type="text" name="studio" id="studio" value="{{ $anime->studio }}">
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
                <img src="{{ h_find_image($anime->image) }}" id="image" class="w-full h-full">
            </div>
            <p class="text-red-500 hidden" id="invalid-msg">Format invalide, formats autorisés: jpg, jpeg, png</p>
            @error('image')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <x-genre-modal :edit-genres="$edit_genres"/>
            @error('genre.*')
            {{ $message }}
            @enderror
            @error('genre')
            {{ $message }}
            @enderror
        </div>
        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>

    <script>
        
        const file = document.getElementById('image-input');
        const acceptedExtensions = ['jpg', 'jpeg', 'png'];
        const previewBox = document.getElementById('preview-box');
        const img = document.getElementById('image');
        const imgInput = document.getElementById('image-input')
        const invalidMsg = document.getElementById('invalid-msg');
    
        file.addEventListener('change', validateImage); 
        if(img.src != '') previewBox.classList.remove('hidden');
    
        function validateImage() {
            
            const ext = imgInput.value.split('.').pop().toLowerCase();
    
            
    
            if(acceptedExtensions.includes(ext)) {
                previewBox.classList.remove('hidden');
                img.src= URL.createObjectURL(this.files[0]);
                invalidMsg.classList.add('hidden');
                return;
            }
            else {
    
                deleteImage();
                invalidMsg.classList.remove('hidden');
            }
        }
    
        function deleteImage() {
            imgInput.value='';
            img.src= '';
            previewBox.classList.add('hidden');
        }
        
    </script>
</x-layouts.admin>
