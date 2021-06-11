<div>
    
    Postez votre commentaire:
    @livewire('comment', ['commentable_id' => $episode_id, 'commentable_type' => 'App\Models\Episode'], key(-6))

    @forelse ($comments as $k=> $comment)
        <h1>Comment n{{ $k }} : {{ $comment->body }}</h1>
        <div>@livewire('comment', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'], key($comment->id))</div>
        <div class="ml-6">
        @forelse ($comment->comments as $item)
            <h1>{{ $item->body }}</h1>
            @livewire('comment', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'], key($item->id))
            {{-- <h1>{{ $comment->body }}</h1> --}}
        
        
        @empty
            
        @endforelse
    </div>
    @empty
        pas encore de commentaires
    @endforelse
   
</div>
