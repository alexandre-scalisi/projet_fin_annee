<form wire:submit.prevent="submit">
    @csrf
    <textarea placeholder="Entrez votre commentaire" name="body" wire:model.lazy="body"></textarea>
    <button type="submit">envoyer</button>
        
</form>
