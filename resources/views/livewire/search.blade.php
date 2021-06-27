<div class="relative" x-data="{focus: false, show:true}">
    <form method="GET" action="{{route('search.index')}}" class="bg-gray-400 rounded-full flex items-center relative px-2"
        :class="{'rounded-b-none rounded-t-2xl' : '{{ $search}}' != '' && show === true }">
        <button class="fa fa-search" aria-hidden="true" type="submit"></button>
        <input type="search" name="q" class="bg-transparent border-none focus:ring-0"
            :class="{'w-80' : '{{ $search}}' != '' && show === true }" @click="show=true" wire:model="search"
            wire:input.key="test" @focusout="focus=false" @input.focus="focus=true">
    </form>

    @if($results && !empty($search))
    <ul @click.away="show=false" x-show="show"
        class="absolute bottom-0 transform translate-y-full w-full rounded-b-2xl overflow-hidden z-50 bg-white">
        @forelse($results as $result)
        <li class="text-gray-100 even:bg-gray-500 bg-gray-600 my-px">
            <a href="{{ route('admin.animes.show', ['anime' => $result->id]) }}">
            <div class="flex items-center">
                <img class="w-20 h-10 mx-2" src="{{ $result->image }}"></img><span
                    class="py-4 inline-block">{{ $result->title }}</span>
              
                </div>
            </a>
        </li>

        @empty
        <li class="text-gray-100 bg-gray-600 py-2 my-px text-left pl-4">Aucun résultat</li>
        @endforelse
    </ul>
    @endif
</div>
