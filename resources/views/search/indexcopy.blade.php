<x-app-layout>
    {{-- {{ dd("".arequest()->query()) }} --}}
    {{-- {{ dd(request()->query()['order_by']) }} --}}
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
                <select name="order_by" id="orderby" x-data="" 
                x-init="
                order_by = '{{ request()->query()['order_by'] ?? ''}}';
                found = [...$el.options].some((e) => e.value === order_by);
                $el.value = found ? order_by : 'title'
                ">
                    {{-- TODO rendre plus propre --}}
                    <option value="title" >nom &uparrow;</option>
                    <option value="vote">note &downarrow;</option>
                    <option value="release_date">date de sortie &downarrow;</option>
                    <option value="upload_date">rajouté le &downarrow;</option>
                </select>
                <input type="hidden" name="l" id="letter">
                <input type="checkbox" name="d" id="direction" {{ isset(request()->query()['d']) && request()->query()['d'] === 'on'  ? 'checked' : '' }}>
                <label for="direction">inverser direction</label>
            </div>

            <button class="bg-blue-400 text-base mr-3">Rechercher</button>
        </form>


    </div>
    <div class="w-full rounded-lg bg-gray-400 p-4">
        <div class="flex space-x-3 flex-wrap" x-data="">
            
            {{-- <form x-ref="form" method="GET" action={{ route('search.index') }}>
                <button type="submit" name="l" value="tous" class="bg-blue-500 px-2 text-gray-100 mb-2">tous</button>
                <button type="submit" name="l" value="autres"
                    class="bg-blue-500 px-2 text-gray-100 mb-2">autres</button>
                @foreach(range('a','z') as $l)
                <button name="l" type="submit" value="{{ $l }}"
                    class="bg-blue-500 px-2 text-gray-100 mb-2">{{ $l }}</button>
                @endforeach
            </form> --}}
            @foreach(array_merge(['tous', 'autres'], range('a','z')) as $l)
            <button type="button" value="{{ $l }}" class="bg-blue-500 px-2 text-gray-100 mb-2"
            onclick="document.getElementById('letter').value = this.value; document.getElementById('form').submit()">{{ $l }}</button>
           @endforeach
        </div>
        @foreach($array as $arr)
        <p><a href="{{ route('animes.show', $arr->id) }}" class="text-blue-600 mb-3">{{ $arr->title }}</a></p>
        @endforeach


        {{ $array->appends(request()->query())->links() }}
    </div>

</x-app-layout>
