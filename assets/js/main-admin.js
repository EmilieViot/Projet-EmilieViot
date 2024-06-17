document.addEventListener("DOMContentLoaded", () => {

    function getRoute() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        return urlParams.get('route');
    }



    const route = getRoute();

    if (route === 'list-messages') {
        const eyeIcon = document.querySelectorAll('.fa-eye');
        eyeIcon.addEventListener('click', function(event) {
            // Empêcher le comportement par défaut du lien
            event.preventDefault();

            // Accéder au parent de l'icône (le <li>), puis à son parent (le <ul>), puis à son parent (la cellule <td>)
            const tdElement = eyeIcon.parentElement.parentElement.parentElement;

            // Sélectionner le premier élément <td> enfant de la cellule <td> (qui contient le numéro de message)
            const messageNumberElement = tdElement.querySelector('td:first-child');

            // Supprimer le style de police en gras
            messageNumberElement.style.fontWeight = 'normal';
        });
    }


    if (route === 'list-opinions') {
        document.querySelectorAll('.status').forEach(selectElement => {
            selectElement.addEventListener('change', function() {
            let status = this.value;
            let id = this.dataset.id;

                // Créer un objet FormData pour envoyer les données
            let formData = new FormData();
            formData.append('id', id);
            formData.append('status', status);

            fetch('index.php?route=status-register', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Traite la réponse JSON
                .then(data => {
                    console.log(data); // Pour déboguer
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    }
});
