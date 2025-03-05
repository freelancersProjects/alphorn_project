document.addEventListener('DOMContentLoaded', function () {
    console.log("App.js loaded!");

    // Trix Editor : Détection de tous les éditeurs Trix sur la page
    document.querySelectorAll('trix-editor').forEach(function (editor) {
        console.log("Trix Editor found");

        // Gestion de l'ajout d'images via le bouton de téléchargement
        editor.addEventListener('trix-attachment-add', function (event) {
            if (event.attachment.file) {
                uploadImage(event.attachment);
            }
        });
    });

    // Fonction d'upload d'image
    function uploadImage(attachment) {
        console.log("Uploading image...");
        const formData = new FormData();
        formData.append('file', attachment.file);

        fetch('/admin/upload-image', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log("Image uploaded:", data.url);
                attachment.setAttributes({
                    url: data.url,
                    href: data.url
                });
            })
            .catch(error => {
                console.error("Upload error:", error);
            });
    }
});
