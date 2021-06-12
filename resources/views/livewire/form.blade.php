<div class="flex flex-col max-w-4xl overflow-y-scroll" style="height: 40rem">
    Postez votre commentaire:
    @livewire('comment', ['commentable_id' => $type_id, 'commentable_type' => "App\Models\\$type"], key(-6))

    @forelse ($comments as $k=> $comment)
    <div x-data="{show: false}">
        <div class="w-80 bg-indigo-400 px-5 py-4 border rounded-lg my-4">
            <h1 class="flex justify-between"> {{ $comment->author->name }} <span
                    class="text-sm">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span></h1>
            <p>{{ $comment->body }} <button class="bg-pink-500 rounded-lg px-3 py-2"
                    @click="show = !show">reply</button></p>
        </div>
        <div x-show="show">@livewire('comment', ['commentable_id' => $comment->id, 'commentable_type' =>
            'App\Models\Comment'],
            key($comment->id))</div>
            {{ $comment->id }}
            {{-- {{ dd($replies) }} --}}
    </div>
    <div class="ml-auto w-96">
        @forelse ($comment->comments()->take($replies[$comment->id])->latest()->get() as $item)
        {{-- @forelse ($comment->comments as $item) --}}
        <div x-data="{show: false}">
            <div class="bg-indigo-400 px-5 py-4 border rounded-lg my-4">
                <h1 class="flex justify-between"> {{ $item->author->name }} <span class="text-sm">
                        {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span></h1>
                <p>{{ $item->body }} <button @click="show = !show"
                        class="bg-pink-500 rounded-lg px-3 py-2">reply</button></p>
            </div>
            <div x-show="show">
                @livewire('comment', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'],
                key($item->id))
            </div>
        </div>
        @empty
        
        @endforelse
        <button wire:click="load_more_replies({{ $comment->id }})">afficher plus</button>
    </div>
    @empty
    pas encore de commentaires
    @endforelse
    <button wire:click.prevent="load_more">Show more</button>
    {{ $comment_quantity }}
</div>
