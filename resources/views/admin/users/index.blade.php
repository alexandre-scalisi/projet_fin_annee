<x-layouts.admin>
    
    <h1 class="text-2xl border-b-4 border-gray-800">Tous les comptes</h1>
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.users.create') }}" class="bg-gray-800 text-gray-200 px-3 py-2 my-5 inline-block">Nouveau</a>
            <div class="w-72">
    
            @livewire('search')
            </div>
    </div>
    <table class="table-auto w-full px-4 mb-4">
        <thead class="bg-blue-400">
            <tr class="text-left">
                {{-- <th class=""><a href="{{ url()->full()."?order_by=title" }}" class="px-5 py-2 inline-block w-full">Nom</a></th> --}}
                
                <th><a href="{{ h_sort_table('email', 'desc') }}" class="px-5 py-2 inline-block w-full">Email</a></th>
                <th><a href="{{ h_sort_table('name', 'desc') }}" class="px-5 py-2 inline-block w-full">Nom</a></th>
                <th><a href="{{ h_sort_table('role', 'desc') }}" class="px-5 py-2 inline-block w-full">Role</a></th>
                <th><a href="{{ h_sort_table('release_date', 'desc') }}" class="px-5 py-2 inline-block w-full">Date d'ajout</a></th>  
                <th class="px-5 py-2 inline-block w-full">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            
            <tr class="even:bg-blue-100">
                <td>
                    <a href="{{ route('admin.users.show', $user->id) }}" class="w-full inline-block px-5 py-3 hover:text-green-700 hover:underline">
                        {{ $user->email }}
                    <a/>
                </td>
                <td class="px-5 py-3">
                    {{ $user->name}}
                </td>
                <td class="px-5 py-3">{{ $user->role_id }}</td>
                <td class="px-5 py-3">{{ $user->created_at }}</td>
                <td class="px-5 py-3">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="fa fa-eye mr-2">
                    </a>
                    <a href="{{ route('admin.users.show', $user->id) }}" class="fa fa-edit mr-2 text-yellow-500">
                    </a>
                    <a href="{{ route('admin.users.destroy', $user->id) }}" class="fa fa-trash mr-2 text-red-500"onclick="return confirm('Êtes vous sûr de vouloir supprimer ?')">
                    </a>
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
    
</x-layouts.admin>