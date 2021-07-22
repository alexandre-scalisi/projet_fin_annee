<table class="table-fixed w-full px-4 mb-4 block overflow-x-scroll">
    <thead class="bg-blue-400">
        <tr class="text-left">
           
            <x-table.th.checkbox />
            {{ $tableHeader }}
            @if (last(explode('/', url()->current())) === "trashed")
            <x-table.th.order-by sort-by="deleted_at" default="desc" center="true">Date de suppression</x-table.th.order-by>
            @else
            <x-table.th.order-by sort-by="created_at" default="desc" center="true">Date de création</x-table.th.order-by>
            @endif
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        {{ $tableBody }}
    </tbody>
</table>