<td class="px-5 py-3" x-data="{modal: false, tooltip: false}">
    <x-table.actions.force-delete :ids=$ids :type=$type :value="$value" :forceDelete="$routes['forceDelete']" />
    <x-table.actions.restore :ids="$ids" :restore="$routes['restore']" />
    
</td>