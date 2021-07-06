<x-layouts.admin>
        <h1 class="text-2xl border-b-4 border-gray-800">Tous les épisodes</h1>
        <div class="flex items-center">
            <div class="w-72 ml-auto my-5">
    
            @livewire('search')
            </div>
        </div>
        <table class="table-auto w-full px-4 mb-4">
            <thead class="bg-blue-400">
                <tr class="text-left">
                    
                    <x-table.th.checkbox />
                    <x-table.th.order-by sort-by="title" default="desc"> Titre </x-table.th.order-by>
                    <x-table.th.order-by sort-by="created_at"> Date d'ajout </x-table.th.order-by>
                    <x-table.th.th>Action</x-table.th.th>
                </tr>
            </thead>
            <tbody>
                @foreach ($episodes as $episode)
                <tr class="even:bg-blue-100">
                    <x-table.td.checkbox :object="$episode" />
                    <td>
                        <a href="{{ route('admin.animes.episodes.show', [$episode->anime->id, $episode->id]) }}" class="w-full inline-block px-5 py-3 hover:text-green-700 hover:underline">
                            {{ $episode->title }}
                        </a>
                    </td>
                    <x-table.td.td> {{ $episode->created_at }}</x-table.td.td>
                    <td class="px-5 py-3">
                        <x-table.actions.show :route="route('admin.animes.episodes.show', [$episode->anime->id, $episode->id])" />
                        </a>
                        <a href="{{ route('admin.animes.episodes.edit', [$episode->anime->id, $episode->id]) }}" class="fa fa-edit mr-2 text-yellow-500">
                        </a>
                        <a href="{{ route('admin.animes.episodes.destroy', [$episode->anime->id, $episode->id]) }}" class="fa fa-trash mr-2 text-red-500"onclick="return confirm('Êtes vous sûr de vouloir supprimer ?')">
                        </a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('admin.episodes.destroy', -1)}}" method="POST">
            @csrf
            @method('DELETE')
            @foreach ($episodes as $episode)
                <input type="checkbox" name="delete[]" value="{{ $episode->id }}" class="check-{{ $episode->id }} hidden">
            @endforeach
            <button class="text-red-600 border border-red-600 px-4 py-1 rounded-full">Supprimer les éléments sélectionnés</button>
        </form>
        
        {{ $episodes->links() }}
        
</x-layouts.admin>



<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les épisodes</x-slot>
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
                <x-table.td.link :show="$routes['show']" hello="abc" :id="object->id" >{{ $object->title }}</x-table.td.link> 
                <x-table.td.td>{{ Carbon\Carbon::parse( $object->release_date)->format('d-m-y') }}</x-table.td.td>
                <x-table.td.td>{{ Carbon\Carbon::parse( $object->created_at)->format('d-m-y') }}</x-table.td.td>
                <x-table.td.td>{{ $object->votes->count() > 0 ? round($object->votes->avg('vote'), 2) : 'Pas de vote'}}</x-table.td.td>
                <x-table.td.td>{{ $object->episodes->count() }}</x-table.td.td>
                <x-table.actions.index-actions :object="$object" :routes="$routes" :type="$type">               
                    <a href="{{ route('admin.animes.episodes.create', $object->id) }}" class="fa fa-plus text-green-600 mr-2 relative" x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                        <x-tooltip left="-30px">
                            Ajouter épisode
                        </x-tooltip>
                    </a>
                </x-table.actions.index-actions>
            </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-table.table-page>