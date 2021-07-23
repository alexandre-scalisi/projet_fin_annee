<x-layouts.admin>
  @forelse ($episodes as $episode)
      <p>{{ $episode->title }}</p>
  @empty
      
  @endforelse
</x-layouts.admin>