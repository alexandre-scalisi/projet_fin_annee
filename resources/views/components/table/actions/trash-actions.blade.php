<td class="text-center py-3 px-5" x-data="{modal: false, tooltip: false}" data-th="Action">
    <x-table.actions.force-delete :ids=$ids :type=$type :value="$value" :forceDelete="$routes['forceDelete']" />
    <x-table.actions.restore :ids="$ids" :restore="$routes['restore']" />
    
</td>