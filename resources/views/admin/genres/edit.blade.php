<x-layouts.admin>
    <x-title border-color="border-gray-800">Modifier genre {{ $genre->name }}</x-title>
    <form method="POST" action="{{ route('admin.genres.update', $genre->id) }}">
        @csrf
        @method('PUT')
        <x-form.basic-input text="Nom" name="name" :value="$genre->name"/>
        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>

</x-layouts.admin>
