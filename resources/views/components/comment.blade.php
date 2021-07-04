
<div :class="{'ring-4 ring-white border border-red-600' : '{{ $item->author->is_logged_in_user() }}' }" class="comment {{ $bgColor }}">
    <h1 class="comment__author"> {{ $is_different() ? $item->author->name : 'Moi' }} 
        <span class="comment__date"> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span>
</h1>
    <p>{{ $item->body }}
       @auth 
       
        @if($is_different())
                <button @click="show = !show" class="comment__reply">reply</button>
        @endif
       
       @endauth

       @if($reply)
       en reponse à {{ $item->parent->author->name }}
       @endif
    </p> 
</div>
