<a href="{{ route( $show, $ids) }}" class="fa fa-eye mr-2 relative" x-data="{tooltip:false}" @mouseenter="tooltip=true" @mouseleave="tooltip=false">
    <x-tooltip left="-10px">
        Voir
    </x-tooltip>
</a>