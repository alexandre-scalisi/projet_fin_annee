<x-layouts.admin>
    <div class="border rounded-lg max-w-7xl w-full px-4 py-6">
        <img src="{{ $user->profile_photo_url }}" class="w-20 h-20 rounded-full mb-4">
        <h1 class="text-4xl mb-2">{{ $user->name }}</h1>
        <p class="mb-2"><span class="font-bold"> Email:</span> {{ $user->email }}</p>
        <p class="mb-2"><span class="font-bold"> Role:</span> {{ $user->role }}</p>
        <p class="mb-2"><span class="font-bold"> Date d'inscription:</span> {{ $user->created_at }}</p>
        <div class="flex gap-x-4 flex-wrap gap-y-2" x-data="{ modal:false }"">
            <x-buttons.button link="{{ route('admin.users.edit', $user->id) }}" icon="fa fa-edit" icon-color="text-yellow-400" bg-color="bg-yellow-600">Editer</x-buttons.button>
            <x-buttons.delete-button >Supprimer</x-buttons.delete-button>
            <x-delete-modal destroy="admin.users.destroy" type="user" :value="$user->id" :ids="$user->id"/>
            <x-buttons.button link="{{ route('admin.users.index') }}" icon="fa fa-arrow-left" icon-color="text-blue-400" bg-color="bg-blue-600">Retour</x-buttons.button>
        </div>
    </div>
</x-layouts.admin>