<a class="fa fa-trash text-red-500 cursor-pointer relative mr-2" @click="modal=true" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
    <x-tooltip left="-30px">
        Supprimer définitivement
    </x-tooltip>
</a>
<x-delete-modal :destroy="$forceDelete" :type="$type" :value="$value" :ids="$ids"/>