<div class="flex m-2 sm:m-4 comment" style="word-break: break-word">

    <img src="{{ $item->author->profile_photo_url }}" class="hidden sm:block w-12 h-12 rounded-full border-2 {{ $item->author->is_logged_in_user() ? 'border-red-400' : 'border-blue-500'}}"">
    <div class="ml-4 text-gray-50">
        <div class="mb-2">
            <h1 class="comment__author {{ $item->author->is_logged_in_user() ? 'text-red-400' : 'text-blue-500' }}"> {{ $is_different() ? $item->author->name : 'Moi' }} </h1>
            <span class="comment__date"> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span>
        </div>
        <p class="mb-2">{{ $item->body }}</p>


        @if($reply)
        <p class="text-gray-500 m-2">
            <i class="fas fa-reply mr-2 my-2"></i>
            En reponse à {{ $item->parent->author->name }}
        </p>
        @endif

        <p> @auth

            @if($is_different())
            <button @click="show = !show" class="text-gray-200">Répondre</button>
            @endif

            @endauth
        </p>
    </div>

</div>
