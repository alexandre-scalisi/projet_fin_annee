<div>
    
    Postez votre commentaire:
    @livewire('comment', ['commentable_id' => $episode_id, 'commentable_type' => 'App\Models\Episode'])

    @forelse ($comments as $k => $comment)
        <h1>Comment n{{ $k + 1 }} : {{ $comment->body }}</h1>
        <div class="mt-4">@livewire('comment', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'])</div>
        <div class="ml-6">
            @forelse ($comment->comments as $key => $item)
                {{ $item->body }}</h1>
            
                @livewire('comment', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'])
                
                
            @empty
                
            @endforelse
        </div>
    @empty
        pas encore de commentaires
    @endforelse
   
</div>
