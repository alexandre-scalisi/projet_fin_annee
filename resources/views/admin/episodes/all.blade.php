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
                    <th class="px-3 relative" x-data="{tooltip: false, allCheckboxes: document.querySelectorAll('[class^=\'check-\']')}">
                        <input type="checkbox" @mouseenter="tooltip=true" @mouseleave="tooltip=false" 
                        @click="isChecked = $event.target.checked === true ? true : false;
                                           [...allCheckboxes].forEach(c => c.checked = isChecked);
                        ">
                        <x-tooltip left="0" top="-40px">
                            Tout cocher
                        </x-tooltip>   
                    </th>
                    
                    <th><a href="{{ h_sort_table('title', 'desc') }}" class="px-5 py-2 inline-block w-full">Titre</a></th>
                    <th><a href="{{ h_sort_table('created_at') }}" class="px-5 py-2 inline-block w-full">Date d'ajout</a></th>
                    <th class="px-5 py-2 inline-block w-full">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($episodes as $episode)
                <tr class="even:bg-blue-100">
                    <td class="px-3">
                        <input type="checkbox" name="check-{{ $episode->id }}" class="check-{{ $episode->id }}" 
                            onclick="const checked = this.checked;
                            [...document.getElementsByClassName('check-{{ $episode->id }}')].forEach(c => c.checked = checked)">
                    </td>
                    <td>
                        <a href="{{ route('admin.animes.episodes.show', [$episode->anime->id, $episode->id]) }}" class="w-full inline-block px-5 py-3 hover:text-green-700 hover:underline">
                            {{ $episode->title }}
                        </a>
                    </td>
                    <td class="px-5 py-3">{{ $episode->created_at }}</td>
                    <td class="px-5 py-3">
                        <a href="{{ route('admin.animes.episodes.show', [$episode->anime->id, $episode->id]) }}" class="fa fa-eye mr-2">
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