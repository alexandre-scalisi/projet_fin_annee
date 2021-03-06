<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les commentaires</x-slot>
    <x-table.table>
        <x-slot name="tableHeader">
            
            <x-table.th.order-by sort-by="email" default="desc">Email</x-table.th.order-by>
            <x-table.th.order-by sort-by="name" default="desc">Nom</x-table.th.order-by>
            <x-table.th.th>Contenu</x-table.th.th>
        </x-slot>
        <x-slot name="tableBody">
            @forelse ($objects as $object)
            <tr class="even:bg-blue-100">
            
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.link :show="$routes['show']" :ids="$object->id" th="Email">{{ $object->author->email }} </x-table.td.link> 
                <x-table.td.td th="Nom">{{ $object->author->name }}</x-table.td.td>
                <x-table.td.td th="Contenu">{{ $object->body }}</x-table.td.td>
                <x-table.td.date :date="$object->created_at" th="Date de création"/>
                    <x-table.actions.td>
                    <x-table.actions.show :show="$routes['show']" :ids="[$object->id]" />
                    <x-table.actions.destroy :destroy="$routes['destroy']" :ids="[$object->id]" type="commentaire" :value="$object->id" />
                </x-table.actions.td>

            </tr>
            @empty
            <tr>
                <td>Pas de resultats</td>
            </tr>
            @endforelse
        </x-slot>
    </x-table.table>
</x-table.table-page> 

