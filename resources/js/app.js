import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

const coverImageInput = document.getElementById("cover_image");
const imagePreview = document.getElementById("image_preview");

if (coverImageInput && imagePreview) {
    coverImageInput.addEventListener("change", function () {
        const uploadedFile = this.files[0];
        if (uploadedFile) {
            const reader = new FileReader();
            reader.addEventListener("load", function () {
                imagePreview.src = reader.result;
            });
            reader.readAsDataURL(uploadedFile);
        }
    });
}

