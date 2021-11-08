const selectImage = () => {
    document.getElementById('avatar').click();
}

const readURL = (input) => {
    let selectedImage = document.getElementById('selectedImage');
    let selectBtn = document.getElementById('selectBtn');
    let removeImage = document.getElementById('removeImage');

    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function(e) {
            $('#previewImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
        selectedImage.classList.add("d-flex");
        removeImage.classList.add("d-flex");
        selectBtn.classList.add("d-none");
    }
}

function removeSelectedImage() {
    let previewImage = document.getElementById('previewImage');
    let selectedImage = document.getElementById('selectedImage');
    let removeImage = document.getElementById('removeImage');
    let selectBtn = document.getElementById('selectBtn');

    previewImage.src = '';
    selectedImage.classList.remove("d-flex");
    removeImage.classList.remove("d-flex");
    selectBtn.classList.remove("d-none");
}
