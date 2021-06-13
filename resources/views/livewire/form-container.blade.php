{{-- TODO Refactoriser dans fichier css et js --}}
<div x-data="">
    <h1>Postez votre commentaire:</h1>
    @livewire('form', ['commentable_id' => $type_id, 'commentable_type' => "App\Models\\$type"], key(-6))
    <div class="flex flex-col w-full max-w-4xl overflow-y-scroll bg-gray-800 relative" style="height: 40rem"
    id="form" @scroll.debounce="scrollFunc($event)">
    <div class="h-10 fixed" x-data="" x-init="test($el)" style="max-width: inherit; background: linear-gradient(to bottom, rgb(0, 0, 0), rgba(0,0,0,0));" id="bg-top" wire:ignore></div>
    
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
            @if($responses['current_amount'] < $responses['count']) <button
            wire:click="load_more_replies({{ $comment->id }})">afficher plus</button>
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
            
            {{-- @push('scripts')
            <script>
                Livewire.on('load_more_comments', () => {
                    const el = document.getElementById('bg-top');
                    const form = document.getElementById('form');
                    form.scrollTop > 0 ? el.classList.add('w-full') : el.classList.remove('w-full')
                    console.log(el.classList)
                })
            </script>
            @endpush --}}
            {{-- <div class="h-10 fixed bottom-0" x-data="" x-init="test($el)" style="max-width: inherit; background: linear-gradient(to bottom, rgb(0, 0, 0), rgba(0,0,0,0));" id="bg-bottom" wire:ignore></div> --}}
            <div class="h-10 fixed" x-data="" x-init="test2($el)" style="max-width: inherit; background: linear-gradient(to top, rgb(0, 0, 0), rgba(0,0,0,0)); transform: translateY(37.5rem)" id="bg-bottom" wire:ignore></div>
        </div>
        <script>
        const form = document.getElementById('form');

        function test(el) {
            console.log('hello')
            
            form.scrollTop > 0 ? el.classList.add('w-full') : el.classList.remove('w-full')
        }
        function test2(el) {
            console.log('hello')
            
            form.scrollTop !== form.scrollTopMax ? el.classList.add('w-full') : el.classList.remove('w-full')
        }
    
        function scrollFunc(ev) {
           
         
            if(ev.target.scrollTop > 0) {
                document.getElementById('bg-top').classList.add('w-full')
            } else {
                document.getElementById('bg-top').classList.remove('w-full')
            }
            if(ev.target.scrollTop !== ev.target.scrollTopMax){
                document.getElementById('bg-bottom').classList.add('w-full')
            } else {
                document.getElementById('bg-bottom').classList.remove('w-full')
            }

            
         
            if (ev.target.scrollTop >= ev.target.scrollTopMax) {
                window.livewire.emit('load_more_comments');
            };
        }
    
        // Livewire.on('load_more_comments', function() {
        //         console.log(test)
        //         el.scrollTop > 0 ? el.classList.add('w-full') : el.classList.remove('w-full')
        //     })
    </script>
</div>