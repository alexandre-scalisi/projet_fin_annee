<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les animes</x-slot>
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
                <x-table.td.link :show="$routes['show']" :ids="$object->id">{{ $object->title }} </x-table.td.link> 
                <x-table.td.td>{{ Carbon\Carbon::parse( $object->release_date)->format('d-m-y') }}</x-table.td.td>
                <x-table.td.td>{{ Carbon\Carbon::parse( $object->created_at)->format('d-m-y') }}</x-table.td.td>
                <x-table.td.td>{{ $object->votes->count() > 0 ? round($object->votes->avg('vote'), 2) : 'Pas de vote'}}</x-table.td.td>
                <x-table.td.td>{{ $object->episodes->count() }}</x-table.td.td>
                <x-table.actions.index-actions :ids="$object->id" :value="$object->id" :routes="$routes" :type="$type">               
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