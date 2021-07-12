<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les épisodes</x-slot>
    <x-table.table>
        <x-slot name="tableHeader">
            <x-table.th.order-by sort-by="title" default="desc"> Titre </x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
        @foreach ($objects as $object)
            <tr class="even:bg-blue-100">
            <x-table.td.checkbox :object="$object"/>
            <x-table.td.link :show="$routes['show']" :ids="[$object->anime->id, $object->id]">{{ $object->title }} </x-table.td.link> 
            <x-table.td.date :date="$object->created_at"/>
            <x-table.actions.index-actions :routes="$routes" type="episodes" :ids="[$object->anime->id, $object->id]" :value="$object->id" />
            </tr>
        @endforeach
        </x-slot>
    </x-table.table>
</x-table.table-page>
