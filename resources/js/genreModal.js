window.genreModal= () => {
    return {



    }
    checked = [...document.querySelectorAll('input')].filter(e => e.checked);
    tooltipText = document.getElementById('tooltip-text');
    getCheckedLabelsText();
    function save() {
        checked = [...document.querySelectorAll('input')].filter(e => e.checked);
        getCheckedLabelsText();
    }


    


    function reboot() {
        checked = [...document.querySelectorAll('[name="genre[]"]')].
            filter(e => {
                if([...checked].includes(e)) {
                    e.checked = true;
                    return true} 
                else 
                    e.checked= false;
                    return false 
                });
    
        getCheckedLabelsText();
    }

    function getCheckedLabelsText() {
        labels = checked.map(c => c.parentElement.getElementsByTagName('label')[0].innerText)
        if(labels.length === 0) {
            tooltipText.innerText = "Veuillez selectionner des catégories";
            return;
        }
        tooltipText.innerText = labels.reduce((a, b) => `${a}, ${b}`);                
        
    }
}