<x-app-layout>

    <div class="max-w-3xl mx-auto m-20">
        <div class="grid grid-cols-3 gap-8">
        @foreach ($animes as $anime)
            <div class="h-60 rounded-xl bg-white overflow-hidden">
                <img src="{{ $anime->image }}" class="h-44 object-cover"></img>
                <div class="px-4 pt-1"><p class="text-lg">{{ $anime->title }}</p>
                <p><span>{{ Carbon\Carbon::createFromTimestamp( $anime->release_date)->format('Y')}} - </span>
                    <span>{{ count($anime->episodes) }} épisodes</span>
                    </p>
                </div>
            </div>
            
            
        @endforeach
        </div>
        {{ $animes->links() }}
    </div>

</x-app-layout>