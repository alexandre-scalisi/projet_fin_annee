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
                <input type="hidden" name="l" id="letter">
                <input type="checkbox" name="d" id="direction"
                    {{ isset(request()->query()['d']) && request()->query()['d'] === 'on'  ? 'checked' : '' }}>
                <label for="direction">inverser direction</label>
            </div>

            <button class="bg-blue-400 text-base mr-3">Rechercher</button>
        </form>


    </div>
    <div class="w-full rounded-lg bg-gray-400 p-4">

        <div class="flex space-x-3 flex-wrap" x-data="">
            @foreach(array_merge(['tous', 'autres'], range('a','z')) as $l)
            <button type="button" value="{{ $l }}" class="bg-blue-500 px-2 text-gray-100 mb-2"
            onclick="document.getElementById('letter').value = this.value;
            document.getElementById('form').submit()">{{ $l }}</button>
            @endforeach
            {{-- @foreach( array_merge(range(0, 5), ['Pas de note', 'Tous']) as $l)
            <button type="button" value="{{ $l }}" class="bg-blue-500 px-2 text-gray-100 mb-2"
                onclick="document.getElementById('letter').value = this.value; document.getElementById('form').submit()">{{ $l }}</button>
            @endforeach --}}
        </div>

        @foreach($array as $a)
        @if(!is_object($a))
        <div class="bg-indigo-700 text-center text-xl text-gray-200 border-indigo-300 border-b-8 mb-1">{{ $a }}</div>
        @else


        <a href="{{ route('animes.show', $a['id'] ) }}">
            <div class="list-none flex bg-indigo-100 mb-2 rounded-sm items-center space-x-4">
                <img src="{{ $a->image }}" class="w-52 h-20" />
                <div>
                    <p class="text-xl font-weight-bolder">{{ $a['title'] }}</p>
                    <p class="mb-1 text-sm">{{ implode(', ', $a->genres->map(function($g) {return $g->name;})->toArray())}}</p>

                    <div class="flex items-center">
                        <small class="mr-4 mt-1">Sortie en {{ date('Y', $a->release_date) }}</small>
                        <x-stars :animeId="$a->id" textSize="text-sm" color="text-blue-600"/>
                    </div>
                </div>
            </div>
        </a>
    @endif

    @endforeach

    {{ $array->appends(request()->query())->links() }}
    </div>
    </div>

</x-app-layout>
