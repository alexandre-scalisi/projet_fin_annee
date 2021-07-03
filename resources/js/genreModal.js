window.genreModal= () => {
    

    return {

        checked: [...document.querySelectorAll('input')].filter(e => e.checked),
        tooltipText: document.getElementById('tooltip-text'),
            
        

        save() {
            this.checked = [...document.querySelectorAll('input')].filter(e => e.checked);
            this.getCheckedLabelsText();
        },



        reboot() {
            
            this.checked = [...document.querySelectorAll('[name="genre[]"]')].
                filter(e => {
                    if([...this.checked].includes(e)) {
                        e.checked = true;
                        return true} 
                    else 
                        e.checked= false;
                        return false 
                    });
        
            this.getCheckedLabelsText();
        },

        getCheckedLabelsText() {
            labels = this.checked.map(c => c.parentElement.getElementsByTagName('label')[0].innerText)
            if(labels.length === 0) {
                
                this.tooltipText.innerText = "Veuillez selectionner des catégories";
                return;
            }
            this.tooltipText.innerText = labels.reduce((a, b) => `${a}, ${b}`);                
        }
    }
}
   
