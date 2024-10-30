 function previewImage(event) {
    const reader = new FileReader();
    const preview = document.getElementById('image-preview');

    reader.onload = function() {
    preview.src = reader.result;
    preview.classList.remove('hidden');
};

    reader.readAsDataURL(event.target.files[0]);
}
