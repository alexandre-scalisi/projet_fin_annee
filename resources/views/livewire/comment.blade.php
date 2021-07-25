<div class="flex m-2 sm:m-4 comment" style="word-break: break-word">
    
    <img src="{{ $item->author->profile_photo_url }}" class="hidden sm:block w-12 h-12 rounded-full border-2 {{ $item->author->is_logged_in_user() ? 'border-red-400' : 'border-blue-500'}}"">
    <div class="ml-4 text-gray-50 w-full">
        <div class="mb-2">
    
            <h1 class="comment__author {{ App\Models\User::onlyTrashed()->find($item->author->id) ? 'text-purple-300' : ($item->author->is_logged_in_user() ? 'text-red-400' : 'text-blue-500') }}"> {{App\Models\User::onlyTrashed()->find($item->author->id) ? 'Utilisateur supprimé': ($this->isDifferent() ? $item->author->name : 'Moi') }} </h1>
            <span class="comment__date"> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span>
            @unless($this->isDifferent() || $this->item->isDeleted())<button wire:click="destroy" class="float-right text-red-500 text-3xl">&times;</button>@endunless
        </div>
        
        @unless($item->isDeleted())
        <p class="mb-2">{{ $item->body }}</p>
        @else 
        commentaire supprimé
        @endunless

        @if($reply)
        <p class="text-gray-500 m-2">
            <i class="fas fa-reply mr-2 my-2"></i>
 
            En reponse à <span class="text-indigo-300">{{ App\Models\User::onlyTrashed()->find($this->item->parent->author->id) ? 'Utilisateur supprimé' : ($this->item->author->id === auth()->user()->id ? $item->parent->author->name : 'Moi')}}</span>
        </p>
        @endif

        <p> @auth
            
            @if(App\Models\Comment::find($item->id) && $this->isDifferent())
            <button @click="show = !show" class="text-gray-200">Répondre</button>
            @endif

            @endauth
        </p>
    </div>

</div>
