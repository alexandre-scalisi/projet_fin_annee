<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    
    <x-slot name="h1">Tous les épisodes supprimés</x-slot>
    <x-table.table :objects="$objects" type="anime" :routes="$routes">
        <x-slot name="tableHeader">
            <x-table.th.order-by sort-by="name" default="desc">Titre </x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @forelse ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.td>{{ $object->title }} </x-table.td.td> 
                <x-table.td.date :date="$object->deleted_at"/>
                <x-table.actions.trash-actions :ids="$object->id" :value="$object->id" :routes="$routes" type="anime" />           
            </tr>    
            @empty
                <tr>
                    <td>Pas de resultats</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table.table>
</x-table.table-page>