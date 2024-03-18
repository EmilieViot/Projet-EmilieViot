/*** MENU ***/
const logoNoScroll = document.getElementById("logoNoScroll");
const logoHeaderScroll = document.getElementById("logoHeaderScroll");
window.addEventListener('scroll', function() {
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


/*** SLIDERS ***/
/* SLIDER REALS */
const prevButtonReal = document.getElementById("prevButtonReal");
const nextButtonReal = document.getElementById("nextButtonReal");
const realSlider = document.querySelectorAll(".realSlider");

let currentRealIndex = 0;

function nextReal() {
    realSlider[currentRealIndex].classList.remove('active');
    currentRealIndex++;
    if (currentRealIndex >= realSlider.length) {
        currentRealIndex = 0;
    }
    realSlider[currentRealIndex].classList.add('active');
}

function prevReal() {
    realSlider[currentRealIndex].classList.remove('active');
    currentRealIndex--;
    if (currentRealIndex < 0) {
        currentRealIndex = realSlider.length - 1; // Aller à la dernière diapositive si on est sur la première
    }
    realSlider[currentRealIndex].classList.add('active');
}
document.addEventListener('DOMContentLoaded', () => {
    prevButtonReal.addEventListener("click", prevReal);
    nextButtonReal.addEventListener("click", nextReal);

// Afficher la première diapositive au chargement de la page
    realSlider[currentRealIndex].classList.add('active');
})

/* SLIDER OPINIONS */
const prevButtonOpinion = document.getElementById("prevButtonOpinion");
const nextButtonOpinion = document.getElementById("nextButtonOpinion");
const opinionSlider = document.querySelectorAll(".opinionSlider");

let currentOpinionIndex = 0;
console.log(currentOpinionIndex);
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