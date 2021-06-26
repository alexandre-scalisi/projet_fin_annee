<x-layouts.admin class="bg-blue-500">
    
    <ul>
    @foreach ($animes as $anime)
      <li>{{ $anime->name }}</li>  
    @endforeach
    </ul>
</x-layouts.admin>