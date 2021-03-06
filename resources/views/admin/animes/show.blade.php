<x-layouts.admin>
    <div class="border rounded-lg max-w-7xl w-full px-4 py-6">
        <img src="{{ h_find_image($anime->image) }}" class="h-20 mb-4">
        <h1 class="mb-4 text-xl font-weight-bolder">{{ $anime->title }}</h1>
        <p class="mb-1.5"><span class="font-bold">Sorti le </span> {{ Str::ucfirst(Carbon\Carbon::parse($anime->release_date)->formatLocalized('%d %B %Y')) }}</p>
        <p class="mb-1.5"><span class="font-bold">Studio(s): </span> {{ $anime->studio }}</p>
        <p class="mb-1.5"><span class="font-bold">Genres: </span> {{ implode(', ', $anime->genres->pluck('name')->toArray()) }}</p>
        <p class="mb-4"><span class="font-bold">Note:</span> <x-stars :animeId="$anime->id" textSize="text-md" color="text-red-500"/></p>
        <div class="flex gap-x-4 flex-wrap gap-y-2" x-data="{ modal:false }"">
            <x-buttons.button link="{{ route('admin.animes.edit', $anime->id) }}" icon="fa fa-edit" icon-color="text-yellow-400" bg-color="bg-yellow-600">Editer</x-buttons.button>
            <x-buttons.delete-button >Supprimer</x-buttons.delete-button>
            <x-delete-modal destroy="admin.animes.destroy" type="animes" :value="$anime->id" :ids="$anime->id"/>
            <x-buttons.button link="{{ route('admin.animes.episodes.create', $anime->id) }}" icon="fa fa-plus" icon-color="text-green-400" bg-color="bg-green-600">Ajouter épisode</x-buttons.button>
            <x-buttons.button link="{{ route('admin.animes.index') }}" icon="fa fa-arrow-left" icon-color="text-blue-400" bg-color="bg-blue-600">Retour</x-buttons.button>
        </div>
    </div>
</x-layouts.admin>