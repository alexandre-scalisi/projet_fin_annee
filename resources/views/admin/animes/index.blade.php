<x-layouts.admin class="bg-blue-500">
    
    <table class="table-auto w-full px-4 mb-4">
        <thead class="bg-blue-400">
            <tr class="text-left">
                <th class="px-5 py-2">Nom</th>
                <th class="px-5 py-2">Date de sortie</th>
                <th class="px-5 py-2">Date d'ajout</th>
                <th class="px-5 py-2">Vote</th>
                <th class="px-5 py-2">Nombre episodes</th>
                <th class="px-5 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($animes as $anime)
            <tr class="even:bg-blue-100">
                <td class="px-5 py-3">{{ $anime->title }}</td>
                <td class="px-5 py-3">{{ date('d-m-Y', $anime->release_date) }}</td>
                <td class="px-5 py-3">{{ $anime->created_at }}</td>
                <td class="px-5 py-3">{{ $anime->votes->count() > 0 ? round($anime->votes->avg('vote'), 2) : 'Pas de vote'}}</td>
                <td class="px-5 py-3 text-center">{{ $anime->episodes->count() }}</td>
                <td class="px-5 py-3 flex items-center">
                    <a href="{{ route('admin.animes.show', $anime->id) }}" class="fa fa-eye mr-2">
                    </a>
                    <a href="{{ route('admin.animes.edit', $anime->id) }}" class="fa fa-edit text-yellow-500 mr-2">
                    </a>
                    <a href="{{ route('admin.animes.destroy', $anime->id) }}" class="fa fa-trash text-red-500">
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $animes->links() }}
    {{-- @foreach ($animes as $anime)
      {{ $anime->title }} 
    @endforeach --}}
</x-layouts.admin>