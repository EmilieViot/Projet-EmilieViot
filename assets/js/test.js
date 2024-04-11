document.addEventListener("DOMContentLoaded", () => {
    const logoNoScroll = document.getElementById("logoNoScroll");
    const logoHeaderScroll = document.querySelector(".logoHeaderScroll");
    const contactBurgerMenu = document.querySelector(".contactBurgerMenu");
    const navBurgerMenu = document.querySelector(".navBurgerMenu");
    let header = document.querySelector('header');

    updateLogos();

    // Fonction pour mettre à jour les logos en fonction de la taille de la fenêtre
    function updateLogos() {
        if (window.innerWidth >= 1200) {
            if (window.scrollY > 20) {
                header.classList.add('scrolled');
                logoNoScroll.style.display = "none";
                logoHeaderScroll.style.display = "block";
                contactBurgerMenu.style.display = "block";
                navBurgerMenu.style.display = "block";
            } else {
                header.classList.remove('scrolled');
                logoNoScroll.style.display = "block";
                logoHeaderScroll.style.display = "none";
                contactBurgerMenu.style.display = "none";
                navBurgerMenu.style.display = "none";
            }
        } else {
            logoHeaderScroll.style.display = "block";
            logoNoScroll.style.display = "none";
            contactBurgerMenu.style.display = "block";
            navBurgerMenu.style.display = "block";
        }
    }
// Mise à jour les logos lorsque la fenêtre est redimensionnée
    window.addEventListener('resize',updateLogos); // Appeler la fonction pour mettre à jour les logos
// Mise à jour les logos lorsque la page est (dé)zoomée
    window.addEventListener('scroll', updateLogos);

/* ** BURGER MENU POUR LES INFOS DE CONTACT ** */
const contactModal = document.querySelector('.modalContactBurger');
const closeContactModalButton = document.querySelector(".close-contactModal");
contactBurgerMenu.addEventListener('click', (e) => {
    contactModal.classList.toggle('modalContactBurger');
    contactModal.classList.toggle('modalContactBurger_visible');
});
closeContactModalButton.addEventListener('click', (e) => {
    contactModal.classList.toggle('modalContactBurger');
    contactModal.classList.toggle('modalContactBurger_visible');
});
function closeContactFromEverywhere() {
    contactModal.classList.remove('modalContactBurger_visible');
    contactModal.classList.add('modalContactBurger');
}
document.addEventListener('click', (e) => {
    if (!contactModal.contains(e.target) && !contactBurgerMenu.contains(e.target)) {
        closeContactFromEverywhere();
    }
});
/* ** BURGER MENU POUR LA NAV ** */
const navModal = document.querySelector('.modalNavBurger');
const closeNavModalButton = document.querySelector(".close-navModal");
navBurgerMenu.addEventListener('click', (e) => {
    navModal.classList.toggle('modalNavBurger');
    navModal.classList.toggle('modalNavBurger_visible');
});
closeNavModalButton.addEventListener('click', (e) => {
    navModal.classList.toggle('modalNavBurger');
    navModal.classList.toggle('modalNavBurger_visible');
});
function closeNavFromEverywhere() {
    navModal.classList.remove('modalNavBurger_visible');
    navModal.classList.add('modalNavBurger');
}
document.addEventListener('click', (e) => {
    if (!navModal.contains(e.target) && !navBurgerMenu.contains(e.target)) {
        closeNavFromEverywhere();
    }
});
});