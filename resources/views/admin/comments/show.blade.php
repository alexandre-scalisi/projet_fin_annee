<x-layouts.admin>
    <div class="border rounded-lg max-w-7xl w-full px-4 py-6">
        <x-title>Commentaire</x-title>
        <p class="mb-3"><span class="font-bold">Auteur : </span>{{ $comment->author->name ?? 'Supprimé' }}</p>
        @if($comment->parent && App\Models\Comment::find($comment->parent->id))
        <p class="mb-3"><span class="font-bold">En réponse à : </span>{{ $comment->parent->author->name ?? 'Supprimé' }}</p>
        @endif
        <p class="mb-3"><span class="font-bold">Message : </span>{{ $comment->body }}</p>
        <div class="flex gap-x-4 flex-wrap gap-y-2" x-data="{ modal:false }"">
            <x-buttons.delete-button >Supprimer</x-buttons.delete-button>
            <x-delete-modal destroy="admin.comments.destroy" type="commentaire" :value="$comment->id" :ids="$comment->id"/>
            <x-buttons.button link="{{ route('admin.comments.index') }}" icon="fa fa-arrow-left" icon-color="text-blue-400" bg-color="bg-blue-600">Retour</x-buttons.button>
        </div>
    </div>
</x-layouts.admin>