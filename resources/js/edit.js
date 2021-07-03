window.edit = () => {

    const file = document.getElementById('image-input');
    const acceptedExtensions = ['jpg', 'jpeg', 'png'];
    const previewBox = document.getElementById('preview-box');
    const img = document.getElementById('image');
    const imgInput = document.getElementById('image-input')
    const invalidMsg = document.getElementById('invalid-msg');

    file.addEventListener('change', validateImage);
    if (img.src != '') previewBox.classList.remove('hidden');

    function validateImage() {

        const ext = imgInput.value.split('.').pop().toLowerCase();



        if (acceptedExtensions.includes(ext)) {
            previewBox.classList.remove('hidden');
            img.src = URL.createObjectURL(this.files[0]);
            invalidMsg.classList.add('hidden');
            return;
        } else {

            deleteImage();
            invalidMsg.classList.remove('hidden');
        }
    }

    function deleteImage() {
        imgInput.value = '';
        img.src = '';
        previewBox.classList.add('hidden');
    }


}
