<x-layouts.admin>
    
    <h1 class="text-2xl border-b-4 border-gray-800">Tous les animes</h1>
    <div class="flex items-center justify-between">
        @if(in_array('create', $routes))
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
            @foreach ($animes as $object)
            <tr class="even:bg-blue-100">
                {{ dd('test') }}
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.link :show="$routes['show']" :id="$object->id">{{ $object->title }} </x-table.td.link> 
                <x-table.td.td>{{ Carbon\Carbon::parse( $anime->release_date)->format('d-m-y') }}</x-table.td.td>
                <x-table.td.td>{{ Carbon\Carbon::parse( $anime->created_at)->format('d-m-y') }}</x-table.td.td>
                <x-table.td.td>{{ $anime->votes->count() > 0 ? round($anime->votes->avg('vote'), 2) : 'Pas de vote'}}</x-table.td.td>
                <x-table.td.td>{{ $anime->episodes->count() }}</x-table.td.td>
                <x-table.actions.td>
                    <x-table.actions.show :id="$anime->id" :show="$routes['show']"/>
                    <x-table.actions.update :id="$anime->id" :update="$routes['update']"/>
                    <x-table.actions.destroy :id="$anime->id" />                    
                    <a href="{{ route('admin.object.episodes.create', $object->id) }}" class="fa fa-plus text-green-600 mr-2 relative" x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                        <x-tooltip left="-30px">
                            Ajouter épisode
                        </x-tooltip>
                    </a>
                </x-table.actions.td>
            </tr>
            @endforeach
        </x-slot>
    </x-table.table>
    <form action="{{ route('admin.animes.destroy', -1)}}" method="POST">
        @csrf
        @method('DELETE')
        @foreach ($animes as $anime)
            <input type="checkbox" name="delete[]" value="{{ $anime->id }}" class="check-{{ $anime->id }} hidden">
        @endforeach
        <button class="text-red-600 border border-red-600 px-4 py-1 rounded-full">Supprimer les éléments sélectionnés</button>
    </form>
    {{ $animes->links() }}
    
</x-layouts.admin>