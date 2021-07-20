<div x-data="">
    <h1 class=" ml-2 sm:ml-0 mt-4 mb-1">Postez votre commentaire:</h1>
    @guest
        <div class="mb-4">
            <p>Vous devez être connecté pour pouvoir poster un commentaire</p>
            <a href="{{ route('login') }}" class="text-blue-600 font-bold text-lg">Connectez vous</a>

        </div>
    @endguest
    
    @auth
        @livewire('form', ['commentable_id' => $type_id, 'commentable_type' => "App\Models\\$type"], key(-6))
    @endauth
    <div class="form-container" id="form" @scroll.debounce="app().scrollFunc($event)">
        <div class="form-container__bg form-container__bg_top hidden" x-data="" x-init="app().test($el)" id="bg-top" wire:ignore></div>

        @forelse ($comments as $comment)
        <div x-data="{show: false}" class="w-full clearfix" style="max-width: 24rem">
            <x-comment :item='$comment' bg-color="bg-indigo-400" />
            <div x-show="show" class="pr-4 form-padding-left">
                @livewire('form', ['commentable_id' => $comment->id, 'commentable_type' => 'App\Models\Comment'],
                key($comment->id))
            </div>
        </div>

        <div class="ml-auto w-full pl-6" style="max-width: 24rem" id="{{ $comment->id }}">

            @forelse ($comment->comments()->take($replies[$comment->id]['current_amount'])->get() as $item)

            <div x-data="{show: false}">
                <x-comment :item='$item' reply="true" bg-color="bg-blue-300" />
                <div x-show="show" class="pr-4 form-padding-left">
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
                wire:click="$emit('load_more_replies', {{$comment->id}})" class="text-blue-400 ml-2">Afficher plus</button>
                @elseif($responses['count'] > $init_replies_amount && $responses['current_amount'] >=
                $responses['count'])
                <button wire:click="$emit('reset_replies_quantity', {{ $comment->id }})" class="text-blue-400 ml-2">Afficher moins</button>
            @endif

        </div>
        @empty
        <p class="text-gray-300 m-2">Soyez le premier à commenter</p>
        @endforelse

        <div class="form-container__bg form-container__bg_bottom hidden" x-data="" x-init="app().test2($el)" id="bg-bottom" wire:ignore></div>

        @push('scripts')
        <script src="{{ mix('js/form-livewire.js') }}"></script>
        @endpush
    </div>
</div>
