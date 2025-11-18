const luni = [
    "Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie",
    "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"
];

const detaliiDiv = document.getElementById("detalii");
const btnDetalii = document.getElementById("btnDetalii");
const spanData = document.getElementById("dataProdus");

// La încărcarea paginii (codul se execută direct fiind la final de body sau putem folosi window.onload) [cite: 199]

// 1. Adăugăm clasa "ascuns" pentru a nu fi vizibil inițial [cite: 200]
detaliiDiv.classList.add("ascuns");

// 2. Obținem și afișăm data curentă [cite: 201, 202]
const d = new Date();
const zi = d.getDate();
const luna = luni[d.getMonth()];
const an = d.getFullYear();

spanData.textContent = `${zi} ${luna} ${an}`;

// La click pe buton [cite: 203]
btnDetalii.addEventListener("click", function() {
    
    // Comutăm vizibilitatea (toggle) [cite: 205]
    detaliiDiv.classList.toggle("ascuns");

    // Modificăm textul butonului în funcție de stare [cite: 206]
    if (detaliiDiv.classList.contains("ascuns")) {
        // Dacă detaliile sunt ascunse
        btnDetalii.textContent = "Afișează detalii"; // [cite: 211, 212]
    } else {
        // Dacă detaliile sunt vizibile
        btnDetalii.textContent = "Ascunde detalii"; // [cite: 208, 209]
    }
});