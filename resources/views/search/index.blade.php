<x-app-layout>
    <div class="w-full rounded-lg bg-gray-300 p-4 mb-4">
        <form method="GET">
        <input type="text" name="q" placeholder="Titre" class="block">
        <button class="bg-blue-400 text-base mr-3">Rechercher</button>
        </form>
        

    </div>
    <div class="w-full rounded-lg bg-gray-400 p-4">
    <div class="flex space-x-3 flex-wrap" x-data="">
      
        <form x-ref="form"method="GET" action={{ route('search.index') }}>
        <button type="submit" name="l" value="tous" class="bg-blue-500 px-2 text-gray-100 mb-2">tous</button>
        <button type="submit" name="l" value="autres" class="bg-blue-500 px-2 text-gray-100 mb-2">autres</button>
        @foreach(range('a','z') as $l)
            <button name="l" type="submit" value="{{ $l }}" class="bg-blue-500 px-2 text-gray-100 mb-2">{{ $l }}</button>
        @endforeach
        </form>
    </div>
    @foreach($array as $a) 
    
        @if(!is_array($a))
        <li>{{ $a }}</li>
        @else
        <p class="ml-2">{{ $a['title'] }} </p>
        @endif

    @endforeach


    {{ $array->links() }}
    </div>

</x-app-layout>