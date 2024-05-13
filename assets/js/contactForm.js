document.querySelector('.contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche le formulaire de se soumettre normalement


    let formData = new FormData();
    formData.append('product_id', product_id);
    const options = {
        method: 'POST',
        body: formData
    };

    fetch('index.php?route=ajouter-au-panier', options)
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
})
