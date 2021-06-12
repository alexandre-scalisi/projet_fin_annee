<div>
<form wire:submit.prevent.lazy="submit">
    @csrf
    <textarea placeholder="Entrez votre commentaire" name="body" wire:model.debounce.500ms="body"></textarea>
    <button type="submit">envoyer</button>
        
    @error('body') {{ $message }} @enderror
</form>
</div>