<x-layouts.admin>
    
    <h1 class="text-2xl border-b-4 border-gray-800">Tous les commentaires</h1>
    <div class="flex items-center">
        <div class="w-72 ml-auto my-5">
            
            @livewire('search')
        </div>
        
    </div>
    <table class="table-auto w-full px-4 mb-4">
        <thead class="bg-blue-400">
            <tr class="text-left">
                {{-- <th class=""><a href="{{ url()->full()."?order_by=title" }}" class="px-5 py-2 inline-block w-full">Nom</a></th> --}}
                
                <th><a href="{{ h_sort_table('author', 'desc') }}" class="px-5 py-2 inline-block w-full">Auteur</a></th>
                <th class="px-5 py-2 inline-block w-full">Contenu</th>
                <th><a href="{{ h_sort_table('created_at', 'desc') }}" class="px-5 py-2 inline-block w-full">Date d'ajout</a></th>
                <th class="px-5 py-2 inline-block w-full">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
            
            <tr class="even:bg-blue-100">
                <td>
                    <a href="{{ route('admin.comments.show', $comment->id) }}" class="w-full inline-block px-5 py-3 hover:text-green-700 hover:underline">
                        {{ $comment->author->email }}
                        
                    <a/>
                </td>
                <td class="px-5 py-3">
                    {{ h_truncate ($comment->body, 10) }}
                </td>
                <td class="px-5 py-3">{{ $comment->created_at }}</td>
                <td class="px-5 py-3">
                    <a href="{{ route('admin.comments.show', $comment->id) }}" class="fa fa-eye mr-2">
                    </a>
                    <a href="{{ route('admin.comments.destroy', $comment->id) }}" class="fa fa-trash mr-2 text-red-500"onclick="return confirm('Êtes vous sûr de vouloir supprimer ?')">
                    </a>
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $comments->links() }}
    
</x-layouts.admin>