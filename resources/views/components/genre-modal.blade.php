<div x-data="{show: false, tooltip: false}"  @keydown.escape="reboot(); show=false;" class="relative my-4">
    
   
    <button type="button" class="bg-blue-700 text-gray-50 px-3 py-2 mb-4" @mouseout="tooltip=false" @mouseenter="tooltip=true" @click.prevent="show=!show">Choisissez vos catégories</button>
    <div x-show="show" class="z-50 relative">
        <div class="fixed bg-gray-800 bg-opacity-95 top-0 left-0 right-0 bottom-0 flex justify-center items-center">
            <div class="bg-white p-8 max-w-5xl w-9/12" @click.away.prevent="show=false">
                <button @click.prevent="reboot(); show= false"class="float-right text-gray-50 w-6 h-6 bg-red-700 rounded-full flex justify-center items-center">&times;</button>
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
                <button type="button" @click="save(); show= false" class="bg-blue-700 text-gray-100 px-3 py-2 mt-2">sauvegarder</button>
                <button @click.prevent="reboot(); show= false"class="bg-red-700 text-gray-100 px-3 py-2 mt-2">Fermer</button>
            </div>
        </div>
    </div>
    <x-tooltip main-color="red-400" secondary-color="gray-800"/>
    
</div>
    
<script> 


    window.genreModal= () => {
        let checked = [...document.querySelectorAll('input')].filter(e => e.checked);
        let tooltipText = document.getElementById('tooltip-text');
        getCheckedLabelsText();
        function save() {
            checked = [...document.querySelectorAll('input')].filter(e => e.checked);
            getCheckedLabelsText();
        }
    

        


        function reboot() {
            checked = [...document.querySelectorAll('[name="genre[]"]')].
                filter(e => {
                    if([...checked].includes(e)) {
                        e.checked = true;
                        return true} 
                    else 
                        e.checked= false;
                        return false 
                    });
        
            getCheckedLabelsText();
        }

        function getCheckedLabelsText() {
            labels = checked.map(c => c.parentElement.getElementsByTagName('label')[0].innerText)
            if(labels.length === 0) {
                tooltipText.innerText = "Veuillez selectionner des catégories";
                return;
            }
            tooltipText.innerText = labels.reduce((a, b) => `${a}, ${b}`);                
            
        }
    }

    

    </script>