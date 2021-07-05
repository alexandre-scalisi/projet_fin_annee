<th class="px-3 relative" x-data="{tooltip: false, allCheckboxes: document.querySelectorAll('[class^=\'check-\']')}">
    <input type="checkbox" @mouseenter="tooltip=true" @mouseleave="tooltip=false" 
    @click="isChecked = $event.target.checked === true ? true : false;
                       [...allCheckboxes].forEach(c => c.checked = isChecked);
    ">
    <x-tooltip left="0" top="-40px">
        Tout cocher
    </x-tooltip>   
</th>