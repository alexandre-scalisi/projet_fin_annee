<div x-data="{show: false, tooltip: false, obj: window.genreModal()}"  @keydown.escape="obj.reboot(); show=false;" class="relative my-4" x-init="obj.getCheckedLabelsText()">
    
   
    <button type="button" class="bg-blue-700 text-gray-50 px-3 py-2 mb-4" @mouseout="tooltip=false" @mouseenter="tooltip=true" @click.prevent="show=!show">Choisissez vos catégories</button>
    <div x-show="show" class="z-50 relative">
        <div class="fixed bg-gray-800 bg-opacity-95 top-0 left-0 right-0 bottom-0 flex justify-center items-center">
            <div class="bg-white p-8 max-w-5xl w-9/12" @click.away.prevent="show=false">
                <button @click.prevent="obj.reboot(); show= false"class="float-right text-gray-50 w-6 h-6 bg-red-700 rounded-full flex justify-center items-center">&times;</button>
                <ul class="grid grid-cols-3">
                @foreach ($genres as $genre)
                    
                @if($editGenres)
                <li><input type="checkbox" name="genre[]" value="{{ $genre->id }}" {{ in_array($genre->id, $editGenres) ? 'checked' : ''}}>
                    <label>{{ $genre->name }}</label>
                </li>
               
                @else<li><input type="checkbox" name="genre[]" value="{{ $genre->id }}" {{ in_array($genre->id, $checkedGenres) ? 'checked' : ''}}>
                        <label>{{ $genre->name }}</label>
                    </li>
                @endif

                @endforeach
                </ul>
                <button type="button" @click="obj.save(); show= false" class="bg-blue-700 text-gray-100 px-3 py-2 mt-2">sauvegarder</button>
                <button @click.prevent="obj.reboot(); show = false"class="bg-red-700 text-gray-100 px-3 py-2 mt-2">Fermer</button>
            </div>
        </div>
    </div>
    <x-custom-tooltip main-color="red-400" secondary-color="gray-800"/>
    
</div>
    
