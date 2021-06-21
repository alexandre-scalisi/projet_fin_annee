<div x-data="{show: false}" @keydown.escape="show=false">
    <button type="button" class="bg-blue-400 text-gray-50 px-3 py-2 rounded-full mb-4" @click.prevent="show=!show">Choisissez vos catégories</button>
    
    <div x-show="show" class="z-50 relative">
        <div class="fixed bg-gray-800 bg-opacity-95 top-0 left-0 right-0 bottom-0 flex justify-center items-center">
            <div class="bg-white p-8 max-w-5xl w-9/12" @click.away.prevent="show=false">
                <button @click.prevent="show=false"class="float-right text-gray-50 w-6 h-6 bg-red-700 rounded-full flex justify-center items-center">&times;</button>
                <ul class="grid grid-cols-3">
                @foreach ($genres as $genre)
            
                    <li><input type="checkbox" name="genre[]" value="{{ $genre->id }}" {{ $checked($genre->id) ? 'checked' : '' }}> <label>{{ $genre->name }}</label></li>
                @endforeach
                </ul>
                <button @click.prevent="show=false"class="bg-red-700 text-gray-100 px-3 py-2 mt-2">Fermer</button>
            </div>
        </div>
    </div>
</div>
