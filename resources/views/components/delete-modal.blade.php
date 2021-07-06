<div class="bg-gray-900 bg-opacity-80 fixed top-0 left-0 h-screen w-screen z-50 flex flex-col items-center justify-center"
    x-show="modal">

    <form action="{{ route($destroy, $ids) }}" method="POST" class="bg-white font-sans" style="width: 21rem">
        @csrf
        @method('DELETE')
        <div class="bg-red-600 h-12 flex items-center justify-around">
            <span>⚠️</span>
            <h3 class="text-2xl text-gray-100">
                Supprimer {{ $type }}
            </h3>
            <span>⚠️</span>

        </div>
        <div class="px-4 py-4 text-xl text-center">
            <p>Etes vous sûr de vouloir supprimer cet {{ $type }} ?</p>
        </div>


        <div class="px-4 py-3 text-lg flex justify-between">
            <input type="hidden" name="delete[]" value="{{ $value }}">
            <button class="bg-gray-900 px-8 py-2 rounded-full text-red-50 ">Confirmer</button>
            <button type="button" @click="modal=false"
                class="border-red-600 text-red-600 border rounded-full px-8 py-2">Annuler</button>
        </div>

    </form>
</div>
