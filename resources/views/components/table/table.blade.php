<table class="table-auto w-full px-4 mb-4">
    <thead class="bg-blue-400">
        <tr class="text-left">
           
            <x-table.th.checkbox />
                {{ $tableHeader }}
            <th class="text-center">Action</th>
        </tr>
    </thead>
    </tbody>
        
        {{ $tableBody }}
        
    </tbody>
</table>