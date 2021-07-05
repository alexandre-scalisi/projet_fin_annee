<td class="px-3">
    
    <input type="checkbox" name="check-{{ $object->id }}" class="check-{{ $object->id }}" 
        onclick="const checked = this.checked;
        [...document.getElementsByClassName('check-{{ $object->id }}')].forEach(c => c.checked = checked)">
</td>