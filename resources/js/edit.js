window.edit = () => {

    return {

        file: document.getElementById('image-input'),
        acceptedExtensions: ['jpg', 'jpeg', 'png'],
        previewBox: document.getElementById('preview-box'),
        img: document.getElementById('image'),
        imgInput: document.getElementById('image-input'),
        invalidMsg: document.getElementById('invalid-msg'),
        

        init() {
            this.file.addEventListener('change', this.validateImage.bind(this));
            if (this.img.src != '') this.previewBox.classList.remove('hidden');
        },

        validateImage() {
            
            const ext = this.imgInput.value.split('.').pop().toLowerCase();

            if (this.acceptedExtensions.includes(ext)) {
                this.previewBox.classList.remove('hidden');
                this.img.src = URL.createObjectURL(this.imgInput.files[0]);
                this.invalidMsg.classList.add('hidden');
                return;
            } else {

                this.deleteImage();
                this.invalidMsg.classList.remove('hidden');
            }
        },

        deleteImage() {
            this.imgInput.value = '';
            this.img.src = '';
            this.previewBox.classList.add('hidden');
        }


    }

}
