{{-- <x-layouts.admin>

    <h1 class="text-2xl border-b-4 border-gray-800">Tous les comptes</h1>
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.users.create') }}"
            class="bg-gray-800 text-gray-200 px-3 py-2 my-5 inline-block">Nouveau</a>
        <div class="w-72">

            @livewire('search')
        </div>
    </div>
    <table class="table-auto w-full px-4 mb-4">
        <thead class="bg-blue-400">
            <tr class="text-left">

                <th><a href="{{ h_sort_table('email', 'desc') }}" class="px-5 py-2 inline-block w-full">Email</a></th>
                <th><a href="{{ h_sort_table('name', 'desc') }}" class="px-5 py-2 inline-block w-full">Nom</a></th>
                <th><a href="{{ h_sort_table('role', 'desc') }}" class="px-5 py-2 inline-block w-full">Role</a></th>
                <th><a href="{{ h_sort_table('created_at', 'desc') }}" class="px-5 py-2 inline-block w-full">Date
                        d'ajout</a></th>
                <th class="px-5 py-2 inline-block w-full">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)

            <tr class="even:bg-blue-100">
                <td>
                    <a href="{{ route('admin.users.show', $user->id) }}"
                        class="w-full inline-block px-5 py-3 hover:text-green-700 hover:underline">
                        {{ $user->email }}
                        <a />
                </td>
                <td class="px-5 py-3">
                    {{ $user->name}}
                </td>
                <td class="px-5 py-3">{{ $user->role }}</td>
                <td class="px-5 py-3">{{ Carbon\Carbon::parse( $user->created_at)->format('d-m-y') }}</td>


                <td class="px-5 py-3 flex items-center justify-center" x-data="{modal: false, tooltip: false}">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="fa fa-eye mr-2 relative"
                        x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                        <x-tooltip>
                            Voir
                        </x-tooltip>
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                        class="fa fa-edit text-yellow-500 mr-2 relative" x-data="{tooltip:false}"
                        @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                        <x-tooltip>
                            Editer
                        </x-tooltip>
                    </a>

                    <a class="fa fa-trash text-red-500 cursor-pointer relative mr-2" @click="modal=true"
                        @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                        <x-tooltip>
                            Supprimer
                        </x-tooltip>
                    </a>
                    <x-delete-modal :action="route('admin.users.destroy', $user->id)" :type="$type" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}

</x-layouts.admin> --}}


<x-table.table-page :routes="$routes" :objects="$objects" :without-trashed-count="$withoutTrashedCount" :trashed-count="$trashedCount">
    <x-slot name="h1">Tous les utilisateurs</x-slot>
    <x-table.table>
        <x-slot name="tableHeader">
            <x-table.th.order-by sort-by="email" default="desc">Email </x-table.th.order-by>
            <x-table.th.order-by sort-by="name" default="desc">Nom</x-table.th.order-by>
            <x-table.th.order-by sort-by="role" default="desc">Role</x-table.th.order-by>
            <x-table.th.order-by sort-by="created_at" default="desc">Date</x-table.th.order-by>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($objects as $object)
            <tr class="even:bg-blue-100">
                <x-table.td.checkbox :object="$object"/>
                <x-table.td.link :show="$routes['show']" :ids="$object->id">{{ $object->email }} </x-table.td.link> 
                <x-table.td.td>{{ $object->name }}</x-table.td.td> 
                <x-table.td.td>{{ $object->role }}</x-table.td.td> 
                <x-table.td.td>{{ Carbon\Carbon::parse( $object->created_at)->format('d-m-y') }}</x-table.td.td>
                <x-table.actions.td>
                    <x-table.actions.show :show="$routes['show']" :ids="[$object->id]" />
                    <x-table.actions.destroy :destroy="$routes['destroy']" :ids="[$object->id]" type="utilisateur" :value="$object->id" />
                </x-table.actions.td>
            </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-table.table-page>