{{-- TODO Refactoriser dans fichier css et js --}}
{{-- @push('head-scripts')
    <script src="{{ mix('js/form.js') }}"></script>
    
@endpush --}}
{{-- TODO reparer background form-container --}}
<div x-data="">
    <h1>Postez votre commentaire:</h1>
    @guest
        <div>
            <p>Vous devez être connecté pour pouvoir poster un commentaire</p>
            <a>Connectez vous</a>

        </div>
    @endguest
    
    @auth
        @livewire('form', ['commentable_id' => $type_id, 'commentable_type' => "App\Models\\$type"], key(-6))
    @endauth
    <div class="form-container" id="form" @scroll.debounce="app().scrollFunc($event)">
        <div class="form-container__bg form-container__bg_top  opacity-0" x-data="" x-init="app().test($el)" id="bg-top" wire:ignore></div>

        @forelse ($comments as $comment)
        <div x-data="{show: false}">
            <x-comment :item='$comment' bg-color="bg-indigo-400" />
            <div x-show="show">
                @livewire('form', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'],
                key($comment->id))
            </div>
        </div>

        <div class="ml-auto" id="{{ $comment->id }}">

            @forelse ($comment->comments()->take($replies[$comment->id]['current_amount'])->get() as $item)

            <div x-data="{show: false}">
                <x-comment :item='$item' reply="true" bg-color="bg-blue-300" />
                <div x-show="show">
                    @livewire('form', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment',
                    'parent_id' => $item->id],
                    key($item->id))
                </div>
            </div>

            @empty
            @endforelse


            @php
            $responses = $replies[$comment->id];
            @endphp

            @if($responses['current_amount'] < $responses['count']) <button
                wire:click="$emit('load_more_replies', {{$comment->id}})">afficher plus</button>
                @elseif($responses['count'] > $init_replies_amount && $responses['current_amount'] >=
                $responses['count'])
                <button wire:click="$emit('reset_replies_quantity', {{ $comment->id }})">afficher moins</button>
                @endif

        </div>
        @empty
        Pas encore de commentaires
        @endforelse

        <div class="form-container__bg form-container__bg_bottom opacity-0" x-data="" x-init="app().test2($el)" id="bg-bottom" wire:ignore></div>

        @push('scripts')
        <script src="{{ mix('js/form-livewire.js') }}"></script>
        @endpush
    </div>
</div>
