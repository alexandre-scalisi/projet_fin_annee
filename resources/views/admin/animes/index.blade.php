<x-layouts.admin>
    
    <h1 class="text-2xl border-b-4 border-gray-800">Tous les animes</h1>
    <div class="flex items-center justify-between">
        @if(array_key_exists('create', $routes))
            <a href="{{ route('admin.animes.create') }}" class="bg-gray-800 text-gray-200 px-3 py-2 my-5 inline-block">Nouveau</a>
        @endif
        <div class="w-72">        
            @livewire('search')
        </div>
    </div>
    <div class="flex py-2">
        <p class="px-2 border-r border-gray-900"><a href="{{ $routes['index'] }}" class="hover:text-green-900 hover:underline font-semibold text-lg">Tous:</a> {{ $withoutTrashedCount }}</p>
        <p class="px-2"><a href="{{ $routes['trash'] }}" class="hover:text-green-900 hover:underline font-semibold text-lg">Corbeille:</a> {{ $trashedCount }}</p>
    </div>
    <x-table.table>
        <x-slot name="tableHeader">
                <x-table.th.order-by sort-by="title" default="desc">Titre </x-table.th.order-by>
                <x-table.th.order-by sort-by="release_date">Date de sortie </x-table.th.order-by>
                <x-table.th.order-by sort-by="created_at">Date d'ajout</x-table.th.order-by>
                <x-table.th.order-by sort-by="vote">Vote</x-table.th.order-by>
                <x-table.th.order-by sort-by="episodes">Nombre épisodes</x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.link :show="$routes['show']" :id="$object->id">{{ $object->title }} </x-table.td.link> 
                <x-table.td.td>{{ Carbon\Carbon::parse( $object->release_date)->format('d-m-y') }}</x-table.td.td>
                <x-table.td.td>{{ Carbon\Carbon::parse( $object->created_at)->format('d-m-y') }}</x-table.td.td>
                <x-table.td.td>{{ $object->votes->count() > 0 ? round($object->votes->avg('vote'), 2) : 'Pas de vote'}}</x-table.td.td>
                <x-table.td.td>{{ $object->episodes->count() }}</x-table.td.td>
                <x-table.actions.td>
                <x-table.actions.show :id="$object->id" :show="$routes['show']"/>
                <x-table.actions.update :id="$object->id" :update="$routes['update']"/>
                <x-table.actions.destroy :destroy="$routes['destroy']" :type="$type" :value="$object->id"/>                    
                <a href="{{ route('admin.animes.episodes.create', $object->id) }}" class="fa fa-plus text-green-600 mr-2 relative" x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                    <x-tooltip left="-30px">
                        Ajouter épisode
                    </x-tooltip>
                    </a>
                </x-table.actions.td>
            </tr>
            @endforeach
        </x-slot>
    </x-table.table>
    <form action="{{ route( $routes['destroy'], -1) }}" method="POST">
        @csrf
        @method('DELETE')
        @foreach ($objects as $object)
            <input type="checkbox" name="delete[]" value="{{ $object->id }}" class="check-{{ $object->id }} hidden">
        @endforeach
        <button class="text-red-600 border border-red-600 px-4 py-1 rounded-full">Supprimer les éléments sélectionnés</button>
    </form>
    {{ $objects->links() }}
    
</x-layouts.admin>