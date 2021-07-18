<x-app-layout>
    
    <h1 class="text-2xl font-bold border-b-4 border-indigo-700 mb-12"> Accueil</h1>
    <div class="flex items-center space-x-4">
        <h2 class="text-xl font-bold tracking-wider">Nouveautés</h2>
        <hr class="border-gray-800 border-t-4 w-full"></hr>
    </div>
    <div class="overflow-hidden relative" x-data="{slider: window.slider()}" x-init="slider.init(); slider.initResize()">
        <button id="left-btn" @click="slider.leftClick()" class="h-full w-10 bg-black absolute flex items-center justify-center bg-opacity-20 top-0 left-0 z-10 hidden">
            <i class="fa fa-arrow-left absolute top-1/2 transform -translate-y-1/2 text-white"></i>
        </button>
        <div class="slider">
            @foreach ($new_animes as $new_anime)
                <a href="{{ route('animes.show', $new_anime->id) }}"class="slider__anime" style="max-height: 150px">
                    <img class="object-cover" style="height: 100px; max-height: 100px" src="{{ h_find_image($new_anime->image) }}"></img>
                    <p class="relative z-50 bg-gray-100">{{ $new_anime->title }}</p>
                </a>

            @endforeach
        </div>
        {{-- <img class="w-1/4 flex-shrink-0 h-32" style="transform: scale(110%)" src="{{ $animes->first()->image }}"></img> --}}
        <button id="right-btn" @click="slider.rightClick()" class="h-full w-10 bg-black absolute flex items-center justify-center bg-opacity-20 top-0 right-0 z-10">
            <i class="fa fa-arrow-right absolute top-1/2 transform -translate-y-1/2 text-white"></i>
        </button>
    </div>
</x-app-layout>