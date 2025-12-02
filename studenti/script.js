/* =========================================
   1. CRONOMETRU SEZON 2025 (Pentru Homepage)
   ========================================= */

const races = [
    { name: "Marele Premiu al Australiei", date: new Date(2025, 2, 16, 7, 0, 0) },
    { name: "Marele Premiu al Chinei", date: new Date(2025, 2, 23, 10, 0, 0) },
    { name: "Marele Premiu al Japoniei", date: new Date(2025, 3, 6, 8, 0, 0) },
    { name: "Marele Premiu al Bahrainului", date: new Date(2025, 3, 13, 18, 0, 0) },
    { name: "Marele Premiu al Arabiei Saudite", date: new Date(2025, 3, 20, 19, 0, 0) },
    { name: "Marele Premiu din Miami", date: new Date(2025, 4, 4, 22, 0, 0) },
    { name: "Marele Premiu Emilia Romagna", date: new Date(2025, 4, 18, 16, 0, 0) },
    { name: "Marele Premiu al Principatului Monaco", date: new Date(2025, 4, 25, 16, 0, 0) },
    { name: "Marele Premiu al Spaniei", date: new Date(2025, 5, 1, 16, 0, 0) },
    { name: "Marele Premiu al Canadei", date: new Date(2025, 5, 15, 21, 0, 0) },
    { name: "Marele Premiu al Qatar-ului", date: new Date(2025, 10, 30 , 18, 0, 0)}
];

function getNextRace() {
    const now = new Date().getTime();
    for (let i = 0; i < races.length; i++) {
        if (races[i].date.getTime() > now) {
            return races[i];
        }
    }
    return null;
}

// Rulăm codul doar dacă suntem pe Homepage (dacă există elementul timer)
const timerElement = document.getElementById("countdown-timer");
const labelElement = document.querySelector("#countdown-container p");

if (timerElement && labelElement) {
    const nextRace = getNextRace();

    if (nextRace) {
        labelElement.innerText = "Următoarea cursă: " + nextRace.name;
        
        const timer = setInterval(function() {
            const now = new Date().getTime();
            const distance = nextRace.date.getTime() - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timerElement.innerHTML = days + "z " + hours + "h " + minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(timer);
                timerElement.innerHTML = "START CURSĂ!";
                timerElement.style.color = "#00ff00";
            }
        }, 1000);
    } else {
        labelElement.innerText = "Sezonul 2025 s-a încheiat!";
        timerElement.innerText = "Ne vedem în 2026!";
    }
}


/* =========================================
   2. FILTRU CĂUTARE PILOȚI (Pentru Pagina Piloți)
   ========================================= */

// Verificăm dacă suntem pe pagina de piloți (dacă există bara de căutare)
const searchInput = document.getElementById('driverSearch');

if (searchInput) {
    // Ascultăm evenimentul de "tastare" (keyup)
    searchInput.addEventListener('keyup', function() {
        
        // Luăm textul scris, îl transformăm în litere mici (pentru a nu conta majusculele)
        const filter = searchInput.value.toLowerCase();
        
        // Luăm toate cardurile de piloți
        const driverCards = document.getElementsByClassName('driver-card');

        // Trecem prin fiecare card
        for (let i = 0; i < driverCards.length; i++) {
            const card = driverCards[i];
            
            // Găsim numele pilotului (h3) și echipa (.driver-team)
            const driverName = card.querySelector('h3').innerText.toLowerCase();
            const driverTeam = card.querySelector('.driver-team').innerText.toLowerCase();

            // Verificăm dacă textul căutat se găsește în Nume SAU în Echipă
            if (driverName.includes(filter) || driverTeam.includes(filter)) {
                card.style.display = ""; // Afișează cardul
            } else {
                card.style.display = "none"; // Ascunde cardul
            }
        }
    });
}

/* =========================================
   3. BUTON BACK TO TOP (MODERN & SMOOTH)
   ========================================= */

// Luăm butonul
const backToTopBtn = document.getElementById("backToTop");

if (backToTopBtn) {
    
    // 1. Arată/Ascunde butonul la scroll
    window.onscroll = function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            backToTopBtn.style.display = "block";
        } else {
            backToTopBtn.style.display = "none";
        }
    };

    // 2. Acțiunea de Click (Smooth Scroll)
    backToTopBtn.addEventListener("click", function() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
}