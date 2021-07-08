<x-layouts.admin>
    
    <h1 class="text-2xl border-b-4 border-gray-800">{{ $h1 }}</h1>
    <div class="flex items-center justify-between">
        @if(array_key_exists('create', $routes))
            <a href="{{ route($routes['create']) }}" class="bg-gray-800 text-gray-200 px-3 py-2 my-5 inline-block">Nouveau</a>
        @endif
        <div class="w-72">        
            @livewire('search')
        </div>
    </div>
    <div class="flex py-2">
        <p class="px-2 border-r border-gray-900"><a href="{{ $routes['index'] }}" class="hover:text-green-900 hover:underline font-semibold text-lg">Tous:</a> {{ $withoutTrashedCount }}</p>
        <p class="px-2"><a href="{{ $routes['trash'] }}" class="hover:text-green-900 hover:underline font-semibold text-lg">Corbeille:</a> {{ $trashedCount }}</p>
    </div>

    {{ $slot }}
    <form action="{{ route( $routes['destroy'] ?? $routes['forceDelete'], [-1, -1]) }}" method="POST" class="inline-block mt-3 mr-2">
        @csrf
        @method('DELETE')
        @foreach ($objects as $object)
            <input type="checkbox" name="delete[]" value="{{ $object->id }}" class="check-{{ $object->id }} hidden">
        @endforeach
        <button class="text-red-600 border border-red-600 px-4 py-1 rounded-full">Supprimer les éléments sélectionnés</button>
    </form>
    @isset($routes['restore'])
    <form action="{{ route($routes['restore'])}}" method="POST" class="inline-block">
        @csrf
        @foreach ($objects as $object)
            <input type="checkbox" name="restore[]" value="{{ $object->id }}" class="check-{{ $object->id }} hidden">
        @endforeach
        <button class="text-gray-800 border border-green-800 px-4 py-1 rounded-full">Restaurer les éléments sélectionnés</button>
    </form>
    @endisset
    
    {{ $objects->links() }}
    
</x-layouts.admin>