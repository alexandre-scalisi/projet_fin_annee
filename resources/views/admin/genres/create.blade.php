<x-layouts.admin>
    <x-title borderColor="border-gray-800">Créer genre</x-title>
    
    <form method="POST" action={{ route('admin.genres.store') }}>
        @csrf
        <x-form.basic-input name="name" text="Nom" :value="old('nom')"/>
        
        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>