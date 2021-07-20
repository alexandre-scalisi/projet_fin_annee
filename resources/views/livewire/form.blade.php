<form wire:submit.prevent.lazy="submit" class="text-gray-400">
    @csrf
    <textarea class="block w-full bg-gray-800" placeholder="Entrez votre commentaire" name="body"
        wire:model.debounce.500ms="body" wire:keydown.enter="submit"></textarea>
    <div class="bg-gray-800 mb-2">
        <button type="submit" class="text-gray-500 px-2">Envoyer</button>
    </div>

    @error('body') {{ $message }} @enderror
</form>
