<x-app-layout>
<div class="-mx-4 sm:mx-0">
    <h1 class="text-2xl font-bold border-b-4 border-indigo-700 mb-8 mx-2 sm:mx-0">Recherche avancée</h1>

    <div class="w-full sm:rounded-lg bg-gray-300 p-4 mb-4">
        <form method="GET" id="form">
            <x-form.container> 
                <label for="q" class="block">Titre</label>
                <input type="text" name="q" id="q">
            </x-form.container>
                <x-form.container>
                <label for="minrating" class="block">Note min</label>
                <select name="minrating" id="minrating" x-data="" x-init="
                minrating = '{{ request()->query()['minrating'] ?? ''}}';
                found = [...$el.options].some((e) => e.value === minrating);
                $el.value = found ? minrating : 0
                ">
                @foreach(range(0, 5) as $num)
                
                <option value="{{ $num }}">{{ $num }}</option>
                
                @endforeach
                </select>
            </x-form.container>
        <x-form.container>
            <label for="orderby" class="block">Trier par</label>
            <select name="order_by" id="orderby" x-data="" x-init="
            order_by = '{{ request()->query()['order_by'] ?? ''}}';
            found = [...$el.options].some((e) => e.value === order_by);
            $el.value = found ? order_by : 'title'
            ">
            {{-- TODO rendre plus propre --}}
            <option value="title">Nom &uparrow;</option>
            <option value="vote">Note &downarrow;</option>
            <option value="release_date">Date de sortie &downarrow;</option>
            <option value="upload_date">Rajouté le &downarrow;</option>
        </select>
        <input type="hidden" name="tab" id="tab">
        <input type="checkbox" name="d" id="direction"
        {{ isset(request()->query()['d']) && request()->query()['d'] === 'on'  ? 'checked' : '' }}>
        <label for="direction">Inverser direction</label>
        </x-form-container>
        <x-genre-modal />
    
            <button class="bg-blue-400 text-base mr-3 px-2 py-1">Rechercher</button>
        </form>


    </div>
    <div class="w-full sm:rounded-lg bg-gray-400 p-4">

        {{-- BUTTONS --}}
        <div class="flex gap-x-2 flex-wrap" x-data="">
            @foreach($tabButtons as $l)
            <button type="button" value="{{ $l }}" class="bg-blue-500 px-2 text-gray-100 mb-2" onclick="document.getElementById('tab').value = this.value;
            document.getElementById('form').submit()">{{ ucfirst($l) }}</button>
            @endforeach

        </div>

        @forelse($query as $anime)

        @if(!is_object($anime))
        <div class="bg-indigo-700 text-center text-xl text-gray-200 border-indigo-300 border-b-8 mb-1">{{ $anime }} </div>
        @else
            <a href="{{ route('animes.show', $anime['id'] ) }}">
                <div class="list-none block sm:flex bg-indigo-100 mb-2 rounded-sm items-center gap-x-4">
                    <img src="{{h_find_image($anime->image )}}" class="block w-full sm:w-52 h-20 object-cover" />
                    <div class="px-2">
                        <p class="text-xl font-weight-bolder">{{ $anime['title'] }}</p>
                        <p class="mb-1 text-sm">
                            {{ implode(', ', $anime->genres->map(function($g) {return $g->name;})->toArray())}}</p>

                        <div class="flex items-center">
                            <small class="mr-4 mt-1">Sortie en {{ Carbon\Carbon::parse($anime->release_date)->format('Y') }}</small>
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
</div>
</x-app-layout>
