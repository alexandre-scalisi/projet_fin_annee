<div>
<form wire:submit.prevent.lazy="submit" class="mx-2">
    @csrf
    <textarea placeholder="Entrez votre commentaire" name="body" wire:model.debounce.500ms="body" wire:keydown.enter="submit"></textarea>
    <button type="submit">envoyer</button>
        
    @error('body') {{ $message }} @enderror
</form>
</div>