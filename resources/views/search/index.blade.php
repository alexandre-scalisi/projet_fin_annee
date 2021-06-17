<x-app-layout>

    @foreach($animes as $anime)

       @foreach($anime as $a) 
           
           {{ $a->title }} </li>
       @endforeach
    

    @endforeach

</x-app-layout>