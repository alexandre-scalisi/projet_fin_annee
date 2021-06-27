<x-layouts.admin>
    <h1 class="text-2xl border-b-4 border-gray-800">Tous les Animes</h1>
    <div class="flex items-center justify-between">
    <a class="bg-gray-800 text-gray-200 px-3 py-2 my-5 inline-block">Nouveau</a>
        <div class="w-72">

        @livewire('search')
        </div>
    </div>
    <table class="table-auto w-full px-4 mb-4">
        <thead class="bg-blue-400">
            <tr class="text-left">
                {{-- <th class=""><a href="{{ url()->full()."?order_by=title" }}" class="px-5 py-2 inline-block w-full">Nom</a></th> --}}
                
                <th><a href="{{ h_sort_table('title', 'desc') }}" class="px-5 py-2 inline-block w-full">Titre</a></th>
                <th><a href="{{ h_sort_table('release_date') }}" class="px-5 py-2 inline-block w-full">Date de sortie</a></th>
                <th><a href="{{ h_sort_table('created_at') }}" class="px-5 py-2 inline-block w-full">Date d'ajout</a></th>
                <th><a href="{{ h_sort_table('vote') }}" class="px-5 py-2 inline-block w-full">Vote</a></th>
                <th><a href="{{ h_sort_table('episodes') }}" class="px-5 py-2 inline-block w-full">Nombre episodes</a></th>
                <th>Action</th>
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
                <td class="px-5 py-3">{{ date('d-m-Y', $anime->release_date) }}</td>
                <td class="px-5 py-3">{{ $anime->created_at }}</td>
                <td class="px-5 py-3">{{ $anime->votes->count() > 0 ? round($anime->votes->avg('vote'), 2) : 'Pas de vote'}}</td>
                <td class="px-5 py-3 text-center">{{ $anime->episodes->count() }}</td>
                <td class="px-5 py-3">
                    <a href="{{ route('admin.animes.show', $anime->id) }}" class="fa fa-eye mr-2">
                    </a>
                    <a href="{{ route('admin.animes.edit', $anime->id) }}" class="fa fa-edit text-yellow-500 mr-2">
                    </a>
                    <a href="{{ route('admin.animes.destroy', $anime->id) }}" class="fa fa-trash text-red-500" onclick="return confirm('Êtes vous sûr de vouloir supprimer ?')">
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $animes->links() }}
    
</x-layouts.admin>