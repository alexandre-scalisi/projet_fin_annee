<x-layouts.admin>
    <div class="border rounded-lg max-w-7xl w-full px-4 py-6">
        <h1 class="text-2xl mb-3">{{ $genre->name }}</h1>
        <ul class="mb-4">
            @forelse ($animes as $anime)
                <li>
                    <a href="{{ route('admin.animes.show', $anime->id) }}" class="flex items-center gap-3 mb-3 hover:text-red-500">
                        <img src="{{ h_find_image($anime->image) }}" class="w-28">
                        <p>{{ $anime->title }}</p>
                    </a>
                    
                </li>

            @empty
                Pas d'animes
            @endforelse

            {{ $animes->links() }}
        </ul>
        <div class="flex gap-x-4 flex-wrap gap-y-2" x-data="{ modal:false }">
            <x-buttons.button link="{{ route('admin.genres.edit', $genre->id) }}" icon="fa fa-edit" icon-color="text-yellow-400" bg-color="bg-yellow-600">Editer</x-buttons.button>
            <x-buttons.delete-button >Supprimer</x-buttons.delete-button>
            <x-delete-modal destroy="admin.genres.destroy" type="genre" :value="$genre->id" :ids="$genre->id"/>
            <x-buttons.button link="{{ route('admin.genres.index') }}" icon="fa fa-arrow-left" icon-color="text-blue-400" bg-color="bg-blue-600">Retour</x-buttons.button>
        </div>
    </div>
</x-layouts.admin>