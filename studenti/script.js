// 1. Lista cu Calendarul Curselor 2025
// Notă: Luna în JavaScript începe de la 0 (0 = Ianuarie, 2 = Martie, etc.)
const races = [
    { name: "Marele Premiu al Australiei", date: new Date(2025, 2, 16, 7, 0, 0) },  // 16 Martie
    { name: "Marele Premiu al Chinei", date: new Date(2025, 2, 23, 10, 0, 0) },     // 23 Martie
    { name: "Marele Premiu al Japoniei", date: new Date(2025, 3, 6, 8, 0, 0) },     // 6 Aprilie
    { name: "Marele Premiu al Bahrainului", date: new Date(2025, 3, 13, 18, 0, 0) },// 13 Aprilie
    { name: "Marele Premiu al Arabiei Saudite", date: new Date(2025, 3, 20, 19, 0, 0) }, // 20 Aprilie
    { name: "Marele Premiu din Miami", date: new Date(2025, 4, 4, 22, 0, 0) },      // 4 Mai
    { name: "Marele Premiu Emilia Romagna", date: new Date(2025, 4, 18, 16, 0, 0) },// 18 Mai
    { name: "Marele Premiu al Principatului Monaco", date: new Date(2025, 4, 25, 16, 0, 0) }, // 25 Mai
    { name: "Marele Premiu al Spaniei", date: new Date(2025, 5, 1, 16, 0, 0) },     // 1 Iunie
    { name: "Marele Premiu al Canadei", date: new Date(2025, 5, 15, 21, 0, 0) },    // 15 Iunie
    // ... poți adăuga restul curselor aici ...
];

// 2. Funcție pentru a găsi următoarea cursă
function getNextRace() {
    const now = new Date().getTime();
    
    // Trecem prin lista de curse
    for (let i = 0; i < races.length; i++) {
        // Dacă data cursei este în viitor (mai mare decât "acum")
        if (races[i].date.getTime() > now) {
            return races[i]; // Aceasta este următoarea cursă!
        }
    }
    return null; // Dacă nu mai sunt curse (sezon terminat)
}

// Găsim cursa țintă
const nextRace = getNextRace();
const labelElement = document.querySelector("#countdown-container p");
const timerElement = document.getElementById("countdown-timer");

// Actualizăm textul etichetei imediat
if (nextRace) {
    labelElement.innerText = "Următoarea cursă: " + nextRace.name;
} else {
    labelElement.innerText = "Sezonul 2025 s-a încheiat!";
    timerElement.innerText = "Ne vedem în 2026!";
}

// 3. Pornim cronometrul doar dacă avem o cursă viitoare
if (nextRace) {
    const timer = setInterval(function() {
        const now = new Date().getTime();
        const distance = nextRace.date.getTime() - now;

        // Calcule matematice
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Afișare
        if (timerElement) {
            timerElement.innerHTML = days + "z " + hours + "h " + minutes + "m " + seconds + "s ";
        }

        // Dacă timpul a expirat (s-a dat startul)
        if (distance < 0) {
            clearInterval(timer);
            timerElement.innerHTML = "START CURSĂ!";
            timerElement.style.color = "#00ff00";
            
            // Opțional: Reîncarcă pagina după 1 minut ca să treacă la următoarea cursă automat
            setTimeout(() => location.reload(), 60000);
        }
    }, 1000);
}