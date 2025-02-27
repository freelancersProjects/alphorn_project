document.addEventListener('DOMContentLoaded', function () {
    const translateButton = document.querySelector('.translate-button');

    if (translateButton) {
        translateButton.addEventListener('click', function (event) {
            event.preventDefault();

            const frValueInput = document.querySelector('input[name="Translation[value_fr]"]');
            const frValue = frValueInput ? frValueInput.value : '';

            if (!frValue) {
                alert("Remplissez d'abord le texte en français !");
                return;
            }

            fetch('/admin/translate-api', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ fr_value: frValue })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.translations) {
                        const itField = document.querySelector('input[name="Translation[value_it]"]');
                        const deField = document.querySelector('input[name="Translation[value_de]"]');

                        if (itField) itField.value = data.translations.it;
                        if (deField) deField.value = data.translations.de;

                        alert('Traductions générées avec succès !');
                    } else {
                        alert('Erreur lors de la traduction.');
                    }
                })
                .catch(error => {
                    alert('Erreur de connexion à l\'API.');
                    console.error(error);
                });
        });
    }
});
