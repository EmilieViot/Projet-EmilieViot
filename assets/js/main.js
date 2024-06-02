/* ** MENU ** */
document.addEventListener("DOMContentLoaded", () => {
    const logoNoScroll = document.getElementById("logoNoScroll");
    const logoHeaderScroll = document.querySelector(".logoHeaderScroll");
    const contactBurgerMenu = document.querySelector(".contactBurgerMenu");
    const navBurgerMenu = document.querySelector(".navBurgerMenu");
    const contactModal = document.querySelector('.modalContactBurger');
    const closeContactModalButton = document.querySelector(".close-contactModal");
    const navModal = document.querySelector('.modalNavBurger');
    const closeNavModalButton = document.querySelector(".close-navModal");
    let header = document.querySelector('header');

    updateLogos();

    function getRoute() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        return urlParams.get('route');
    }

    const route = getRoute();

    /* ** BACK-TO-TOP-BUTTON ** */
    window.onscroll = function () {
        scrollFunction()
    };

    document.getElementById("scrollToTopButton").addEventListener("click", scrollToTop);

    function scrollFunction() {
        if (/*document.body.scrollTop > 20 || */document.documentElement.scrollTop > 20) {
            document.getElementById("scrollToTopButton").style.display = "block";
        } else {
            document.getElementById("scrollToTopButton").style.display = "none";
        }
    }

    function scrollToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    /* ** BASCULE DE LOGO DANS LE HEADER ** */


    // Fonction pour mettre à jour les logos en fonction de la taille de la fenêtre
    function updateLogos() {
        if (window.innerWidth >= 1200) {
            if (window.scrollY > 20) {
                header.classList.add('scrolled');
                logoNoScroll.style.display = "none";
                contactModal.style.display = "block";
                navModal.style.display = "block";
                closeContactModalButton.style.display = "block";
                closeNavModalButton.style.display = "block";
                logoHeaderScroll.style.display = "block";
                contactBurgerMenu.style.display = "block";
                navBurgerMenu.style.display = "block";
            } else {
                header.classList.remove('scrolled');
                logoNoScroll.style.display = "block";
                contactModal.style.display = "block";
                closeContactModalButton.style.display = "none";
                closeNavModalButton.style.display = "none";
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

    let isScrolling = false;

    window.addEventListener('scroll', function () {
        if (!isScrolling) {
            window.requestAnimationFrame(function () {
                updateLogos();
                isScrolling = false;
            });
            isScrolling = true;
        }
    });

// Déclenche la mise à jour des logos lors du redimensionnement de la fenêtre
    window.addEventListener('resize', function () {
        updateLogos();
    });

// Exécuter la fonction une fois au chargement de la page pour initialiser les logos
    updateLogos();

    /* ** BURGER MENU POUR LES INFOS DE CONTACT ** */
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
    /* ** SLIDERS ** */
    /* SLIDER REALS - HOME */
    if (route === 'home' || route === null) {
        const homePrevButtonReal = document.querySelector(".homePrevButtonReal");
        const homeNextButtonReal = document.querySelector(".homeNextButtonReal");
        const homeRealSliders = document.querySelectorAll(".homeRealSlider");
        let currentRealIndex = 0;

        // console.log(currentRealIndex);
        function homeNextReal() {
            homeRealSliders[currentRealIndex].classList.remove('active');
            currentRealIndex++;
            // console.log(currentRealIndex);
            if (currentRealIndex >= homeRealSliders.length) {
                currentRealIndex = 0;
            }
            homeRealSliders[currentRealIndex].classList.add('active');
        }

        function homePrevReal() {
            homeRealSliders[currentRealIndex].classList.remove('active');
            currentRealIndex--;
            // console.log(currentRealIndex);
            if (currentRealIndex < 0) {
                currentRealIndex = homeRealSliders.length - 1; // Aller à la dernière diapo si on est sur la première
            }
            homeRealSliders[currentRealIndex].classList.add('active');
        }

        homePrevButtonReal.addEventListener("click", homePrevReal);
        homeNextButtonReal.addEventListener("click", homeNextReal);
        homeRealSliders[currentRealIndex].classList.add('active');


        /* SLIDER OPINIONS */
        const prevButtonOpinion = document.querySelector(".prevButtonOpinion");
        const nextButtonOpinion = document.querySelector(".nextButtonOpinion");
        const opinionSlider = document.querySelectorAll(".opinionSlider");
        let currentOpinionIndex = 0;

        function nextOpinion() {
            opinionSlider[currentOpinionIndex].classList.remove('active');
            currentOpinionIndex++;
            if (currentOpinionIndex >= opinionSlider.length) {
                currentOpinionIndex = 0;
            }
            opinionSlider[currentOpinionIndex].classList.add('active');
        }

        function prevOpinion() {
            opinionSlider[currentOpinionIndex].classList.remove('active');
            currentOpinionIndex--;
            if (currentOpinionIndex < 0) {
                currentOpinionIndex = opinionSlider.length - 1;
            }
            opinionSlider[currentOpinionIndex].classList.add('active');
        }

        prevButtonOpinion.addEventListener("click", prevOpinion);
        nextButtonOpinion.addEventListener("click", nextOpinion);
        opinionSlider[currentOpinionIndex].classList.add('active');
    }

    /* SLIDER REALS - PAGE REALS */
    if (route === 'realisations') {
        let currentSlideIndex = 0;
        // console.log(currentSlideIndex);
        const realSections = document.querySelectorAll(".realSection");
        realSections.forEach(section => {
            const realPrevButton = section.querySelector(".prevButtonReal");
            const realNextButton = section.querySelector(".nextButtonReal");
            const realSliderImgs = section.querySelectorAll(".realSliderImg");
            realSliderImgs[currentSlideIndex].classList.add('active');

            function nextSlide() {
                realSliderImgs[currentSlideIndex].classList.remove('active');
                currentSlideIndex++;
                // console.log(currentSlideIndex);
                if (currentSlideIndex >= realSliderImgs.length) {
                    currentSlideIndex = 0;
                }
                realSliderImgs[currentSlideIndex].classList.add('active');
            }

            function prevSlide() {
                realSliderImgs[currentSlideIndex].classList.remove('active');
                currentSlideIndex--;
                // console.log(currentSlideIndex);
                if (currentSlideIndex < 0) {
                    currentSlideIndex = realSliderImgs.length - 1; // Aller à la dernière diapo si on est sur la première
                }
                realSliderImgs[currentSlideIndex].classList.add('active');
            }

            realPrevButton.addEventListener("click", prevSlide);
            realNextButton.addEventListener("click", nextSlide);
        });
    }

    /* MODALE - PAGE ONE SERVICE */
    if (route === 'service' || route === 'realisation') {
        const thumbnails = document.querySelectorAll('.thumbnails');
        const modal = document.querySelector('.modal');
        const modalImage = document.getElementById('modal-image');
        const close = document.querySelector('.close');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function (event) {
                const imageUrl = event.currentTarget.getAttribute('src');
                modal.style.display = 'block';
                modalImage.src = imageUrl;
            });
        });

        close.addEventListener('click', function () {
            closeModal();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        document.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        function closeModal() {
            modal.style.display = 'none';
        }
    }

    /* FORMULAIRE CONTACT */

    if (route === 'contact') {
        document.getElementsByClassName("send-contactInfos").addEventListener("click", function () {
            // Récupérer les données du formulaire
            const formData = new FormData(document.getElementById("contactForm"));
            // Envoyer les données au serveur avec Fetch
            fetch("index.php?route=messageRegister", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    console.log('message bien envoyé')
                })
        });
    }

    if (route === 'contact') {
        const contactForm = document.querySelector('.contactForm');
        contactForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Empêche le formulaire de se soumettre normalement

            let formulaireData = new FormData(contactForm); // Utilisation de la variable 'form' au lieu de 'this'

            fetch('index.php?route=contact', {
                method: 'POST',
                body: formulaireData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Affiche la réponse du script PHP
                    console.log('message bien envoyé en back office')
                })

        });
    }

    if (route === 'contact') {
           const contactForm = document.getElementsByClassName('contactForm');

            contactForm.addEventListener('submit', function (event) {
                event.preventDefault(); // Empêche le comportement par défaut du formulaire

                const formData = new FormData(contactForm); // Récupère les données du formulaire

                fetch('index.php?route=messageRegister', { // Envoie les données au script PHP
                method: 'POST',
                    body: formData,
            })

                .then(response => response.json()) // Traite la réponse JSON
                .then(data => {
                    document.getElementsByClassName('contactFormOKMessage').textContent = data.message;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('contactFormOKMessage').textContent = 'Une erreur est survenue.';
                });
            });
    }


    /* ** FORMULAIRE DEMANDE DE DEVIS * **/
    if (route === 'pricing') {
        let contact_mode = document.getElementById("contact_mode");
        let firstname = document.getElementById("firstname");
        let lastname = document.getElementById("lastname");
        let telField = document.getElementById("tel");
        let emailField = document.getElementById("email");
        let btn = document.querySelector("button[type='submit']");
        contact_mode.addEventListener("change", function () {
            if (contact_mode.value === "Téléphone") {
                telField.setAttribute("required", "required");
                emailField.removeAttribute("required");
            } else if (contact_mode.value === "Email") {
                emailField.setAttribute("required", "required");
                telField.removeAttribute("required");
            }
        });
        btn.addEventListener("click", function (event) {
            if ((firstname.value === "")) {
                event.preventDefault();
                alert("Veuillez renseigner votre prénom.");
            } else if ((lastname.value === "")) {
                event.preventDefault();
                alert("Veuillez renseigner votre nom.");
            } else if ((contact_mode.value === "Téléphone" && telField.value === "")) {
                event.preventDefault();
                alert("Veuillez renseigner votre numéro de téléphone pour être recontacté(e).");
            } else if (contact_mode.value === "Email" && emailField.value === "") {
                event.preventDefault();
                alert("Veuillez renseigner votre adresse email pour être recontacté(e).");
            }
        });
    }

    /* ACCESSIBILITE - POLICES */
    const increaseFontButton = document.getElementById('increase-font');
    const decreaseFontButton = document.getElementById('decrease-font');

    const changeFontSize = (amount) => {
        const currentFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize);
        const newFontSize = currentFontSize + amount;
        document.documentElement.style.fontSize = newFontSize + 'px';
    };

    increaseFontButton.addEventListener('click', function () {
        changeFontSize(2); // Augmente la taille de 2 pixels
    });

    decreaseFontButton.addEventListener('click', function () {
        changeFontSize(-2); // Diminue la taille de 2 pixels
    });


    /* ACCESSIBILITE - CONTRASTE */
    const contrastButton = document.getElementById('contrast');


})

