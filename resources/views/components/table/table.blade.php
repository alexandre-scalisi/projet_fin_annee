<table class="table-auto w-full px-4 mb-4">
    <thead class="bg-blue-400">
        <tr class="text-left">
            {{-- <th class=""><a href="{{ url()->full()."?order_by=title" }}" class="px-5 py-2 inline-block w-full">Nom</a></th> --}}
            <th class="px-3 relative" x-data="{tooltip: false, allCheckboxes: document.querySelectorAll('[class^=\'check-\']')}">
                <input type="checkbox" @mouseenter="tooltip=true" @mouseleave="tooltip=false" 
                @click="isChecked = $event.target.checked === true ? true : false;
                                   [...allCheckboxes].forEach(c => c.checked = isChecked);
                ">
                <x-tooltip left="0" top="-40px">
                    Tout cocher
                </x-tooltip>   
            </th>
            <th><a href="{{ h_sort_table('title', 'desc') }}" class="px-5 py-2 inline-block w-full">Titre</a></th>
            <th><a href="{{ h_sort_table('release_date') }}" class="px-5 py-2 inline-block w-full">Date de sortie <i class="{{ h_sortArrow('release_date') }}"></i></a></th>
            <th><a href="{{ h_sort_table('created_at') }}" class="px-5 py-2 inline-block w-full">Date d'ajout <i class="{{ h_sortArrow('created_at') }}"></i></a></th>
            <th><a href="{{ h_sort_table('vote') }}" class="px-5 py-2 inline-block w-full">Vote <i class="{{ h_sortArrow('vote') }}"></i></a></th>
            <th><a href="{{ h_sort_table('episodes') }}" class="px-5 py-2 inline-block w-full">Nombre episodes <i class="{{ h_sortArrow('episodes') }}"></i></a></th>
            <th class="text-center">Action</th>
        </th>
    </thead>
    <tbody>
        @foreach ($animes as $anime)
        
        <tr class="even:bg-blue-100">
            <td class="px-3">
                <input type="checkbox" name="check-{{ $anime->id }}" class="check-{{ $anime->id }}" 
                    onclick="const checked = this.checked;
                    [...document.getElementsByClassName('check-{{ $anime->id }}')].forEach(c => c.checked = checked)">
            </td>
            <td>
                <a href="{{ route('animes.show', $anime->id) }}" class="w-full inline-block px-5 py-3 hover:text-green-700 hover:underline">
                    {{ $anime->title }}
                </a>
            </td>
            <td class="px-5 py-3">{{ Carbon\Carbon::parse( $anime->release_date)->format('d-m-y') }}</td>
            <td class="px-5 py-3">{{ Carbon\Carbon::parse( $anime->created_at)->format('d-m-y') }}</td>
            <td class="px-5 py-3">{{ $anime->votes->count() > 0 ? round($anime->votes->avg('vote'), 2) : 'Pas de vote'}}</td>
            <td class="px-5 py-3 text-center">{{ $anime->episodes->count() }}</td>
            <td class="px-5 py-3" x-data="{modal: false, tooltip: false}">
                <a href="{{ route('admin.animes.show', $anime->id) }}" class="fa fa-eye mr-2 relative" x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                    <x-tooltip left="-10px">
                        Voir
                    </x-tooltip>
                </a>
                <a href="{{ route('admin.animes.edit', $anime->id) }}" class="fa fa-edit text-yellow-500 mr-2 relative" x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                    <x-tooltip left="-20px">
                        Editer
                    </x-tooltip>
                </a>
                
                <a class="fa fa-trash text-red-500 cursor-pointer relative mr-2" @click="modal=true" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                    <x-tooltip left="-30px">
                        Supprimer
                    </x-tooltip>
                </a>
                <x-delete-modal :action="route('admin.animes.destroy', $anime->id)" :type="$type" :value="$anime->id"/>
                <a href="{{ route('admin.animes.episodes.create', $anime->id) }}" class="fa fa-plus text-green-600 mr-2 relative" x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                    <x-tooltip left="-30px">
                        Ajouter épisode
                    </x-tooltip>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>