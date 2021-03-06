{{-- {{  dd(route('animes.index', array_merge(request()->all(), ['order_by' => 'osef'])))}} --}}
<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les animes</x-slot>
    <x-table.table>
        <x-slot name="tableHeader">
            <x-table.th.order-by sort-by="title" default="desc">Titre </x-table.th.order-by>
            <x-table.th.order-by sort-by="episodes" default="desc">Nombre épisodes</x-table.th.order-by>
            <x-table.th.order-by sort-by="vote" default="desc">Vote</x-table.th.order-by>
            <x-table.th.order-by sort-by="release_date" default="desc" center="true">Date de sortie </x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @forelse ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.link :show="$routes['show']" :ids="$object->id" th="Titre">{{ $object->title }} </x-table.td.link> 
                <x-table.td.td th="Nombre épisodes">{{ $object->episodes->count() }}</x-table.td.td>
                <x-table.td.td th="Vote">{{ $object->votes->count() > 0 ? round($object->votes->avg('vote'), 2) : 'Pas de vote' }}</x-table.td.td>
                <x-table.td.date :date="$object->release_date" th="Date de sortie"/>
                <x-table.td.date :date="$object->created_at" th="Date de Création"/>
                <x-table.actions.index-actions :ids="$object->id" :value="$object->id" :routes="$routes" type="anime">               
                    <a href="{{ route('admin.animes.episodes.create', $object->id) }}" class="fa fa-plus text-green-600 mr-2 relative" x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                        <x-tooltip left="-30px">
                            Ajouter épisode
                        </x-tooltip>
                    </a>
                </x-table.actions.index-actions>
            </tr>
            @empty
            <tr>
                <td>Pas de resultats</td>
            </tr>
            @endforelse
        </x-slot>
    </x-table.table>
</x-table.table-page>

