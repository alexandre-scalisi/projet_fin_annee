<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    
    <x-slot name="h1">Tous les commentaires supprimés</x-slot>
    <x-table.table :objects="$objects" type="anime" :routes="$routes">
        <x-slot name="tableHeader">
            <x-table.th.order-by sort-by="email" default="desc">Email</x-table.th.order-by>
            <x-table.th.order-by sort-by="name" default="desc">Nom</x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @forelse ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.td th="Email">{{ $object->name }} </x-table.td.td> 
                <x-table.td.td th="Nom">{{ $object->author->name }}</x-table.td.td>
                <x-table.td.td th="Contenu" center="true">{{ $object->body }}</x-table.td.td>
                <x-table.td.date :date="$object->deleted_at" th="Date de suppression" />
                <x-table.actions.trash-actions :ids="$object->id" :value="$object->id" :routes="$routes" type="commentaire" />           
            </tr>    
            @empty
                <tr>
                    <td>Pas de resultats</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table.table>
</x-table.table-page>