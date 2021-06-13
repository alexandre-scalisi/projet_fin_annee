<div class="flex flex-col max-w-4xl overflow-y-scroll bg-gray-800" x-data="" style="height: 40rem" id="form" @scroll.debounce="scrollFunc($event)">
    Postez votre commentaire:
    @livewire('form', ['commentable_id' => $type_id, 'commentable_type' => "App\Models\\$type"], key(-6))

    @forelse ($comments as $k=> $comment)
    <div x-data="{show: false}">
        <x-comment :item='$comment' bg-color="bg-indigo-400" />
        <div x-show="show">
            @livewire('form', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'],
            key($comment->id))
        </div>
    </div>

    <div class="ml-auto">

        @forelse ($comment->comments()->take($replies[$comment->id]['current_amount'])->latest()->get() as $item)

        <div x-data="{show: false}">
            <x-comment :item='$item' bg-color="bg-red-600" />
            <div x-show="show">
                @livewire('form', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'],
                key($item->id))
            </div>
        </div>

        @empty
        @endforelse
        @php
            $responses = $replies[$comment->id];
        @endphp
        @if($responses['current_amount'] < $responses['count'])
            <button wire:click="load_more_replies({{ $comment->id }})">afficher plus</button>
            @elseif($responses['count'] > $init_replies_amount && $responses['current_amount'] >=
            $responses['count'])
            <button wire:click="reset_replies_quantity({{ $comment->id }})">afficher moins</button>
            @endif
            {{-- {{ count($comment->comments) > $initial_replies_quantity && $replies[$comment->id] === count($comment->comments) }}
            --}}

    </div>
    @empty
    Pas encore de commentaires
    @endforelse

</div>

<script>
    function scrollFunc(ev) {
        console.log(ev.target)
            if (ev.target.scrollTop >= ev.target.scrollTopMax) {
                window.livewire.emit('load_more_comments');
        };
    }
</script>
