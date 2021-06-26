<x-app-layout>

    <div class="w-full rounded-lg bg-gray-300 p-4 mb-4">
        <form method="GET" id="form">

            <input type="text" name="q" placeholder="Titre" class="block">
            <x-genre-modal />
            <div class="block">
                <label for="minrating">min rating</label>
                <select name="minrating" id="minrating" x-data="" x-init="
                minrating = '{{ request()->query()['minrating'] ?? ''}}';
                found = [...$el.options].some((e) => e.value === minrating);
                $el.value = found ? minrating : 0
                ">
                    @foreach(range(0, 5) as $num)

                    <option value="{{ $num }}">{{ $num }}</option>

                    @endforeach
                </select>
            </div>

            <div class="block">
                <label for="orderby">trier par</label>
                <select name="order_by" id="orderby" x-data="" x-init="
                order_by = '{{ request()->query()['order_by'] ?? ''}}';
                found = [...$el.options].some((e) => e.value === order_by);
                $el.value = found ? order_by : 'title'
                ">
                    {{-- TODO rendre plus propre --}}
                    <option value="title">nom &uparrow;</option>
                    <option value="vote">note &downarrow;</option>
                    <option value="release_date">date de sortie &downarrow;</option>
                    <option value="upload_date">rajouté le &downarrow;</option>
                </select>
                <input type="hidden" name="tab" id="tab">
                <input type="checkbox" name="d" id="direction"
                    {{ isset(request()->query()['d']) && request()->query()['d'] === 'on'  ? 'checked' : '' }}>
                <label for="direction">inverser direction</label>
            </div>

            <button class="bg-blue-400 text-base mr-3">Rechercher</button>
        </form>


    </div>
    <div class="w-full rounded-lg bg-gray-400 p-4">

        {{-- BUTTONS --}}
        <div class="flex space-x-2 flex-wrap" x-data="">
            @foreach($tabButtons as $l)
            <button type="button" value="{{ $l }}" class="bg-blue-500 px-2 text-gray-100 mb-2" onclick="document.getElementById('tab').value = this.value;
            document.getElementById('form').submit()">{{ $l }}</button>
            @endforeach

        </div>

        @forelse($query as $anime)

        @if(!is_object($anime))
        <div class="bg-indigo-700 text-center text-xl text-gray-200 border-indigo-300 border-b-8 mb-1">{{ $anime }} </div>
        @else
            <a href="{{ route('animes.show', $anime['id'] ) }}">
                <div class="list-none flex bg-indigo-100 mb-2 rounded-sm items-center space-x-4">
                    <img src="{{ $anime->image }}" class="w-52 h-20" />
                    <div>
                        <p class="text-xl font-weight-bolder">{{ $anime['title'] }}</p>
                        <p class="mb-1 text-sm">
                            {{ implode(', ', $anime->genres->map(function($g) {return $g->name;})->toArray())}}</p>

                        <div class="flex items-center">
                            <small class="mr-4 mt-1">Sortie en {{ date('Y', $anime->release_date) }}</small>
                            <x-stars :animeId="$anime->id" textSize="text-sm" color="text-blue-600" />
                        </div>
                    </div>
                </div>
            </a>
        @endif

        @empty
        <p>Pas de résultat</p>
        @endforelse

        {{ $query->appends(request()->query())->links() }}
        </div>
    </div>

</x-app-layout>
