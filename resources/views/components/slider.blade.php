<div class="mb-12">
    <div class="flex items-center space-x-4 mb-3">
        <h2 class="text-xl font-bold tracking-wider flex-shrink-0">{{ $title }}</h2>
        <hr class="border-gray-600 border-t-4 w-full">
        </hr>
    </div>
    <div class="overflow-hidden relative" x-data="{slider: window.slider('{{$slider}}', '{{ $slider }}__anime')}"
        x-init="slider.init(); slider.initResize()">
        <button @click="slider.leftClick()"
            class="{{ $slider }}__left-btn h-full w-10 absolute flex items-center justify-center top-0 left-0 z-10 hidden focus:outline-none">
            <i class="fa fa-arrow-left absolute top-1/2 transform -translate-y-1/2 text-white text-3xl"
                style="text-shadow: 0 0 5px black"></i>
        </button>
        <div class="{{ $slider }}">
            @foreach ($newAnimes as $new_anime)
            <a href="{{ route('animes.show', $new_anime->id) }}" class="{{ $slider }}__anime" style="max-height: 150px">
                <img class="object-cover" style="height: 100px; max-height: 100px"
                    src="{{ h_find_image($new_anime->image) }}"></img>
                <p class="relative z-50 bg-gray-100">{{ $new_anime->title }}</p>
            </a>

            @endforeach
        </div>
        {{-- <img class="w-1/4 flex-shrink-0 h-32" style="transform: scale(110%)" src="{{ $animes->first()->image }}"></img>
        --}}
        <button @click="slider.rightClick()"
            class="{{ $slider }}__right-btn h-full w-10 absolute flex items-center justify-center top-0 right-0 z-10 focus:outline-none">
            <i class="fa fa-arrow-right absolute top-1/2 transform -translate-y-1/2 text-white text-3xl"
                style="text-shadow: 0 0 5px black"></i>
        </button>
    </div>
</div>
