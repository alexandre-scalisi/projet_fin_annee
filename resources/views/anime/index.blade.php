<x-app-layout>

    <div class="grid grid-cols-3 gap-x-8 gap-y-14 mb-6">
        @foreach ($animes as $anime)
        <div class="rounded-lg bg-white overflow-hidden shadow-lg transition all transform hover:-translate-y-2 duration-500 hover:shadow-2xl" style="min-height: 6rem">
            <a href="{{ route('animes.show', $anime->id) }}" class="overflow-hidden block">
                <img src="{{ $anime->image }}" class="transform transition-all duration-500 hover:scale-125 hover:brightness-50 h-56 object-cover filter"></img>
                
            </a>
            <div class="px-4 py-3 g-1">
                <a href="{{ route('animes.show', $anime->id) }}" class="text-lg leading-tight mb-2 block">{{ $anime->title }}</a>
                <p class="text-sm"><span>{{ Carbon\Carbon::createFromTimestamp( $anime->release_date)->format('Y')}} -
                    </span>
                    <span>{{ count($anime->episodes) }} épisodes</span>
                </p>
            </div>
        </div>


        @endforeach
    </div>
    {{ $animes->links() }}
</x-app-layout>
