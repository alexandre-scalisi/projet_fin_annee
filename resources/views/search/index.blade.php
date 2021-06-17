<x-app-layout>


    @foreach($array as $a) 
    
    @if(!is_array($a))
    <li>{{ $a }}</li>
    @else
    <p class="ml-2">{{ $a['title'] }} </p>
    @endif
    {{-- {{ dd($a) }} --}}
    @endforeach

    {{ $array->links() }}
   
    

</x-app-layout>