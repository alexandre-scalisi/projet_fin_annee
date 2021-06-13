
<div class="{{ $bgColor }} px-5 py-4 border rounded-lg my-4 w-80 comment mx-2 {{ $item->author->is_logged_in_user() ? 'ring-4 ring-white' : ''}}">
    <h1 class="flex justify-between"> {{ $is_different() ? $item->author->name : 'Moi' }} <span class="text-sm">
            {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span></h1>
    <p>{{ $item->body }}
       @auth 
        @if($is_different())
                <button @click="show = !show" class="bg-yellow-100 rounded-lg px-3 py-2">reply</button>
        @endif
       
       @endauth
       @if($reply)
       en reponse à {{ $item->parent->author->name }}
@endif
    </p> 
</div>

