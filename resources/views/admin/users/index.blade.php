<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les utilisateurs</x-slot>
    <x-table.table>
        <x-slot name="tableHeader">
            <x-table.th.order-by sort-by="email" default="desc">Email </x-table.th.order-by>
            <x-table.th.order-by sort-by="name" default="desc">Nom</x-table.th.order-by>
            <x-table.th.order-by sort-by="role" default="desc">Role</x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @forelse ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.link :show="$routes['show']" :ids="$object->id" th="Email">{{ $object->email }} </x-table.td.link> 
                <x-table.td.td th="Nom">{{ $object->name }}</x-table.td.td> 
                <x-table.td.td th="Role">{{ $object->role }}</x-table.td.td> 
                <x-table.td.date :date="$object->created_at" th="Date de création"/>
                <x-table.actions.index-actions :ids="$object->id" :value="$object->id" :routes="$routes" type="utilisateur" />
            </tr>
            @empty
            <tr>
                <td>Pas de resultats</td>
            </tr>
            @endforelse
        </x-slot>
    </x-table.table>
</x-table.table-page>