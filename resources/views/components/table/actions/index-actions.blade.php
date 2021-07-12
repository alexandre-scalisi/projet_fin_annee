<td class="py-3 text-center" x-data="{modal: false, tooltip: false}">
    <x-table.actions.show :ids="$ids" :show="$routes['show']"/>
    <x-table.actions.update :id="$ids" :update="$routes['update']"/>
    <x-table.actions.destroy :destroy="$routes['destroy']" :type="$type" :value="$value" :ids="$ids"/>
    {{ $slot }}
</td>