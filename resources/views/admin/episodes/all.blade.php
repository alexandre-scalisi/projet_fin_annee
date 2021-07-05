<x-layouts.admin>
        <h1 class="text-2xl border-b-4 border-gray-800">Tous les épisodes</h1>
        <div class="flex items-center">
            <div class="w-72 ml-auto my-5">
    
            @livewire('search')
            </div>
        </div>
        <table class="table-auto w-full px-4 mb-4">
            <thead class="bg-blue-400">
                <tr class="text-left">
                    
                    <x-table.th.checkbox />
                    <x-table.th.order-by sort-by="title" default="desc" text="abc"> Titre </x-table.th.order-by>
                    <x-table.th.order-by sort-by="created_at"> Date d'ajout </x-table.th.order-by>
                    <x-table.th.th>Action</x-table.th.th>
                </tr>
            </thead>
            <tbody>
                @foreach ($episodes as $episode)
                <tr class="even:bg-blue-100">
                    <x-table.td.checkbox :object="$episode" />
                    <td>
                        <a href="{{ route('admin.animes.episodes.show', [$episode->anime->id, $episode->id]) }}" class="w-full inline-block px-5 py-3 hover:text-green-700 hover:underline">
                            {{ $episode->title }}
                        </a>
                    </td>
                    <x-table.td.td> {{ $episode->created_at }}</x-table.td.td>
                    <td class="px-5 py-3">
                        <x-table.actions.show :route="route('admin.animes.episodes.show', [$episode->anime->id, $episode->id])" />
                        </a>
                        <a href="{{ route('admin.animes.episodes.edit', [$episode->anime->id, $episode->id]) }}" class="fa fa-edit mr-2 text-yellow-500">
                        </a>
                        <a href="{{ route('admin.animes.episodes.destroy', [$episode->anime->id, $episode->id]) }}" class="fa fa-trash mr-2 text-red-500"onclick="return confirm('Êtes vous sûr de vouloir supprimer ?')">
                        </a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('admin.episodes.destroy', -1)}}" method="POST">
            @csrf
            @method('DELETE')
            @foreach ($episodes as $episode)
                <input type="checkbox" name="delete[]" value="{{ $episode->id }}" class="check-{{ $episode->id }} hidden">
            @endforeach
            <button class="text-red-600 border border-red-600 px-4 py-1 rounded-full">Supprimer les éléments sélectionnés</button>
        </form>
        
        {{ $episodes->links() }}
        
</x-layouts.admin>