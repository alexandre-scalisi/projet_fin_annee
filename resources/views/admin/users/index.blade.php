<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les utilisateurs</x-slot>
    <x-table.table>
        <x-slot name="tableHeader">
            <x-table.th.order-by sort-by="email" default="desc">Email </x-table.th.order-by>
            <x-table.th.order-by sort-by="name" default="desc">Nom</x-table.th.order-by>
            <x-table.th.order-by sort-by="role" default="desc">Role</x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.link :show="$routes['show']" :ids="$object->id">{{ $object->email }} </x-table.td.link> 
                <x-table.td.td>{{ $object->name }}</x-table.td.td> 
                <x-table.td.td>{{ $object->role }}</x-table.td.td> 
                <x-table.td.date :date="$object->created_at"/>
                <x-table.actions.index-actions :ids="$object->id" :value="$object->id" :routes="$routes" type="anime"></x-table.actions.index-actions>
            </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-table.table-page>