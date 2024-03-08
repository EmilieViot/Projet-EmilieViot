// TRAITEMENT FORMULAIRE AVIS
document.getElementById('submitBtn').addEventListener('click', function() {
    submitForm();
});

// Fonction pour soumettre le formulaire
function submitForm() {
    // Récupérez les données du formulaire
    const content = document.getElementById('content').value;
    const rating = document.getElementById('rating').value;
    const realisationId = document.getElementById('realisation_id').value;

    // Créez un objet FormData pour les données du formulaire
    const formData = new FormData();
    formData.append('content', content);
    formData.append('rating', rating);
    formData.append('realisation_id', realisationId);

    // Effectuez une requête Fetch pour envoyer les données au serveur
    fetch('url_du_serveur', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            // Traitez la réponse du serveur ici
            console.log(data);
        })
        .catch(error => {
            // Gérez les erreurs ici
            console.error('Erreur lors de l\'envoi du formulaire :', error);
        });
}