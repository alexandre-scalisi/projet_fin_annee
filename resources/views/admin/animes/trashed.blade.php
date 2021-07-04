<x-layouts.admin>

    <h1 class="text-2xl border-b-4 border-gray-800">Tous les animes</h1>
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.animes.create') }}" class="bg-gray-800 text-gray-200 px-3 py-2 my-5 inline-block">Nouveau</a>
        <div class="w-72">
            
            @livewire('search')
        </div>
    </div>
    <div class="flex py-2">
        <p class="px-2 border-r border-gray-900"><a href="{{ route('admin.animes.index') }}" class="hover:text-green-900 hover:underline font-semibold text-lg">Tous:</a> {{ $withoutTrashedCount }}</p>
        <p class="px-2"><a href="{{ route('admin.animes.trashed') }}" class="hover:text-green-900 hover:underline font-semibold text-lg">Corbeille:</a> {{ $trashedCount }}</p>
    </div>
    <table class="table-auto w-full px-4 mb-4">
        <thead class="bg-blue-400">
            <tr class="text-left">
                {{-- <th class=""><a href="{{ url()->full()."?order_by=title" }}" class="px-5 py-2 inline-block w-full">Nom</a></th> --}}
                
                <th><a href="{{ h_sort_table('title', 'desc') }}" class="px-5 py-2 inline-block w-full">Titre</a></th>
                <th><a href="{{ h_sort_table('deleted_at') }}" class="px-5 py-2 inline-block w-full">Date de suppression</a></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($animes as $anime)
            <tr class="even:bg-blue-100">
                <td>
                    <a href="{{ route('animes.show', $anime->id) }}" class="w-full inline-block px-5 py-3 hover:text-green-700 hover:underline">
                        {{ $anime->title }}
                    </a>
                </td>
                
                <td class="px-5 py-3">{{ Carbon\Carbon::parse( $anime->deleted_at)->format('d-m-y') }}</td>
                <td class="px-5 py-3" x-data="{modal: false, tooltip: false}">
                    <form method="POST" action="{{ route('admin.animes.restore', $anime->id) }}" class="inline-block relative" x-data="{tooltip:false}">
                        @csrf
                        <button class="fa fa-backward mr-2 relative"  @mouseenter="tooltip=true" @mouseleave="tooltip=false"></button>
                        <x-tooltip left="-10px">
                            Restaurer
                        </x-tooltip>
                    </form>

                    <a class="fa fa-trash text-red-500 cursor-pointer relative mr-2" @click="modal=true" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
                        <x-tooltip left="-30px">
                            Supprimer Définitivement
                        </x-tooltip>
                    </a>
                    <x-delete-modal :action="route('admin.animes.forceDelete', $anime->id)" :type="$type"/>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $animes->links() }}
    
</x-layouts.admin>