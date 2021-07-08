<form method="POST" action="{{ route($restore) }}" class="inline-block relative" x-data="{tooltip:false}">
    @csrf
    <input type="hidden" name="restore[]" value="{{ $ids }}">
    <button class="fa fa-backward mr-2 relative"  @mouseenter="tooltip=true" @mouseleave="tooltip=false"></button>
    <x-tooltip left="-10px">
        Restaurer
    </x-tooltip>
</form>