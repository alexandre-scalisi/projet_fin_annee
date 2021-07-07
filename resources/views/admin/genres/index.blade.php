<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les genres</x-slot>
    <x-table.table>
        <x-slot name="tableHeader">
                {{-- <th class=""><a href="{{ url()->full()."?order_by=title" }}" class="px-5 py-2 inline-block w-full">Nom</a></th> --}}
                <x-table.th.order-by sort-by="name" default="desc">Nom</x-table.th.order-by>
                <x-table.th.order-by sort-by="created_at">Date d'ajout</x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.link :show="$routes['show']" :ids="$object->id">{{ $object->name }} </x-table.td.link> 
                <x-table.td.td>{{ Carbon\Carbon::parse( $object->created_at)->format('d-m-y') }}</x-table.td.td>
    
                <x-table.actions.index-actions :ids="$object->id" :value="$object->id" :routes="$routes" type="genre">
                </x-table.actions.index-actions>
            </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-table.table-page>