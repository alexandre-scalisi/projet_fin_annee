<div>
<form wire:submit.prevent.lazy="submit">
    @csrf
    <textarea placeholder="Entrez votre commentaire" name="body" wire:model="body"></textarea>
    <button type="submit">envoyer</button>
        
</form>
</div>