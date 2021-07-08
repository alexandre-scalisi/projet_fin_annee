{{-- <x-layouts.admin>

    <h1 class="text-2xl border-b-4 border-gray-800">Tous les animes</h1>
    <div class="flex items-center justify-between">
        <div class="ml-auto mt-4">
            
            @livewire('search')
        </div>
    </div>
    <div class="flex py-2">
        <p class="px-2 border-r border-gray-900"><a href="{{ route('admin.animes.index') }}" class="hover:text-green-900 hover:underline font-semibold text-lg">Tous:</a> {{ $withoutTrashedCount }}</p>
        <p class="px-2"><a href="{{ route('admin.animes.trashed') }}" class="hover:text-green-900 hover:underline font-semibold text-lg">Corbeille:</a> {{ $trashedCount }}</p>
    </div>
    <table class="table-auto w-full px-4 mb-4">
        <thead class="bg-blue-400">
            <tr class="text-left">
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
                <th><a href="{{ h_sort_table('deleted_at') }}" class="px-5 py-2 inline-block w-full">Date de suppression</a></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($animes as $anime)
            <tr class="even:bg-blue-100">
                <td class="px-3">
                    <input type="checkbox" name="check-{{ $anime->id }}" class="check-{{ $anime->id }}" 
                        onclick="const checked = this.checked;
                        [...document.getElementsByClassName('check-{{ $anime->id }}')].forEach(c => c.checked = checked)">
                </td>
                <td class="px-5 py-3">
                    {{ $anime->title }}
                </td>
                
                <td class="px-5 py-3">{{ Carbon\Carbon::parse( $anime->deleted_at)->format('d-m-y') }}</td>
                <td class="px-5 py-3" x-data="{modal: false, tooltip: false}">
                    <form method="POST" action="{{ route('admin.animes.restore') }}" class="inline-block relative" x-data="{tooltip:false}">
                        @csrf
                        <input type="hidden" name="restore[]" value="{{ $anime->id }}">
                        <button class="fa fa-backward mr-2 relative"  @mouseenter="tooltip=true" @mouseleave="tooltip=false"></button>
                        <x-tooltip left="-10px">
                            Restaurer
                        </x-tooltip>
                    </form>

                    <a class="fa fa-trash text-red-500 cursor-pointer relative mr-2" @click="modal=true" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                        <x-tooltip left="-30px">
                            Supprimer Définitivement
                        </x-tooltip>
                    </a>
                    <x-delete-modal :action="route('admin.animes.forceDelete')" :type="$type" :value="$anime->id"/>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('admin.animes.forceDelete')}}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        @foreach ($animes as $anime)
            <input type="checkbox" name="delete[]" value="{{ $anime->id }}" class="check-{{ $anime->id }} hidden">
        @endforeach
        <button class="text-red-600 border border-red-600 px-4 py-1 rounded-full">Supprimer les éléments sélectionnés</button>
    </form>
    <form action="{{ route('admin.animes.restore')}}" method="POST" class="inline-block">
        @csrf
        @foreach ($animes as $anime)
            <input type="checkbox" name="restore[]" value="{{ $anime->id }}" class="check-{{ $anime->id }} hidden">
        @endforeach
        <button class="text-gray-800 border border-green-800 px-4 py-1 rounded-full">Restaurer les éléments sélectionnés</button>
    </form>
    {{ $animes->links() }}
    
</x-layouts.admin> --}}


<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les animes supprimés</x-slot>
    <x-table.table :objects="$objects" type="anime" :routes="$routes">
        
        <x-slot name="tableHeader">
            <x-table.th.order-by sort-by="title" default="desc">Titre </x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.td>{{ $object->title }} </x-table.td.td> 
                <x-table.td.date :date="$object->deleted_at"/>
                <x-table.actions.trash-actions :ids="$object->id" :value="$object->id" :routes="$routes" type="anime" />           
            </tr>    
            @endforeach
        </x-slot>
    </x-table.table>
</x-table.table-page>