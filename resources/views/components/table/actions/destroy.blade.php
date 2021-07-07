
<a class="fa fa-trash text-red-500 cursor-pointer relative mr-2" x-init="console.log('test')" @click="modal=true" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
    <x-tooltip left="-30px">
        Supprimer
    </x-tooltip>
</a>
<x-delete-modal :destroy="$destroy" :type="$type" :value="$value" :ids="$ids"/>