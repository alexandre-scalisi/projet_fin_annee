<style>
    @media(max-width: 767px) {
        .table-auto thead {
            display: none;
        }
        
        .table-auto,
        .table-auto tbody,
        .table-auto tr,
        .table-auto td {
            display: block;
            width: 100%;
        }
       

        .table-auto tr {
            margin-bottom: 25px;
        }
        
        .table-auto td:not(:first-child) {
            text-align: right;
            padding-left: 40%;
            text-align: right;
            position: relative;
            
        }

        .table-auto tr:nth-child(odd) td:not(:first-child) {
            border-bottom: #DBEAFE 1px solid;
        }
        .table-auto tr:nth-child(even) td:not(:first-child) {
            border-bottom: white 1px solid;
        }
        

        .table-auto td:not(:first-child)::before {
            content: attr(data-th) ": ";
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-size: 15px;
            font-weight: bold;
            text-align: left;
            top: 50%;
            transform: translateY(-50%);
        }


    }

</style>
<table class="table-auto w-full mb-4">
    <th class="md:hidden px-3 relative" x-data="{tooltip: false, allCheckboxes: document.querySelectorAll('[class^=\'check-\']')}">
        <input type="checkbox" @mouseenter="tooltip=true" @mouseleave="tooltip=false" 
        @click="isChecked = $event.target.checked === true ? true : false;
                           [...allCheckboxes].forEach(c => c.checked = isChecked);
        ">   
        Tout cocher
    </th>
    <thead class="bg-blue-400">
        <tr class="text-left">

            <x-table.th.checkbox />
            {{ $tableHeader }}
            @if (last(explode('/', url()->current())) === "trashed")
            <x-table.th.order-by sort-by="deleted_at" default="desc" center="true">Date de suppression
            </x-table.th.order-by>
            @else
            <x-table.th.order-by sort-by="created_at" default="desc" center="true">Date de création
            </x-table.th.order-by>
            @endif
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        {{ $tableBody }}
    </tbody>
</table>
