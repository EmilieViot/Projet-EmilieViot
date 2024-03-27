/* ** MENU ** */
document.addEventListener("DOMContentLoaded", () => {
    function getRoute()
    {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        return urlParams.get('route');
    }
    const route = getRoute();

/* ** BASCULE DE LOGO DANS LE HEADER ** */
    const logoNoScroll = document.getElementById("logoNoScroll");
    const logoHeaderScroll = document.getElementById("logoHeaderScroll");
    window.addEventListener('scroll', function () {
        let header = document.querySelector('header');
        if (window.scrollY > 0) {
            header.classList.add('scrolled');
            logoNoScroll.style.display = "none";
            logoHeaderScroll.style.display = "block";
        } else {
            header.classList.remove('scrolled');
            logoNoScroll.style.display = "block";
            logoHeaderScroll.style.display = "none";
        }
    });

/* ** SLIDERS ** */

    /* SLIDER REALS - HOME */
    if(route === 'home') {
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
    if(route === 'realisations') {
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
    if(route === 'service') {
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

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        document.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        function closeModal() {
            modal.style.display = 'none';
        }
    }

/* ** FORMULAIRE DEMANDE DE DEVIS * **/
    if(route === 'pricing') {
        let contactMode = document.getElementById("contactMode");
        let telField = document.getElementById("tel");
        let emailField = document.getElementById("email");
        let btn = document.querySelector("button[type='submit']");
        contactMode.addEventListener("change", function () {
            if (contactMode.value === "Téléphone") {
                telField.setAttribute("required", "required");
                emailField.removeAttribute("required");
            } else if (contactMode.value === "Email") {
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
            } else if ((contactMode.value === "Téléphone" && telField.value === "")) {
                event.preventDefault();
                alert("Veuillez renseigner votre numéro de téléphone pour être recontacté(e).");
            } else if (contactMode.value === "Email" && emailField.value === "") {
                event.preventDefault();
                alert("Veuillez renseigner votre adresse email pour être recontacté(e).");
            }
        });
    }
});