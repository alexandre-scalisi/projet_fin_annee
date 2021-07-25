<x-layouts.admin>
  <div class="border rounded-lg max-w-7xl w-full px-4 py-6">
    <img src="{{ h_find_image($episode->anime->image) }}" class="h-20 mb-4">
    <h1 class="mb-4 text-xl font-weight-bolder">{{ $episode->title }}</h1>
    <ul>
      @forelse($episode->links() as $k => $link)
        <li class="hover:text-blue-600 cursor-pointer">
          <a href="{{ $link }}">{{ $k }} => {{ $link }}</a>
        </li>
      @empty
      Pas encore de lien
      @endforelse

    </ul>
    <div class="flex gap-x-4 flex-wrap gap-y-2 mt-4" x-data="{ modal:false }"">
      <x-buttons.button link="{{ route('admin.animes.episodes.edit', [$episode->anime->id, $episode->id]) }}" icon="fa fa-edit" icon-color="text-yellow-400" bg-color="bg-yellow-600">Editer</x-buttons.button>
      <x-buttons.delete-button >Supprimer</x-buttons.delete-button>
      <x-delete-modal destroy="admin.animes.episodes.destroy" type="episodes" :value="$episode->id" :ids="[$episode->anime->id, $episode->id]"/>
      <x-buttons.button link="{{ route('admin.episodes.index') }}" icon="fa fa-arrow-left" icon-color="text-blue-400" bg-color="bg-blue-600">Retour</x-buttons.button>
  </div>
  </div>
</x-layouts.admin>