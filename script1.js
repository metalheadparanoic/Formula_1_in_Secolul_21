// Lista lunilor în limba română 
const luni = [
    "Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie",
    "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"
];

const btnAdauga = document.getElementById("btnAdauga");
const inputActivitate = document.getElementById("inputActivitate");
const listaActivitati = document.getElementById("listaActivitati");

// Eveniment la click pe buton
btnAdauga.addEventListener("click", function() {
    const textActivitate = inputActivitate.value;

    // Verificăm dacă textul nu este gol 
    if (textActivitate !== "") {
        
        // Creăm noul element li 
        const elementNou = document.createElement("li");

        // Obținem data curentă 
        const d = new Date();
        const zi = d.getDate();
        const luna = luni[d.getMonth()]; // Luna format text
        const an = d.getFullYear();

        // Construim textul: Activitate - adăugată la: ZI LUNA AN 
        elementNou.textContent = `${textActivitate} - adăugată la: ${zi} ${luna} ${an}`;

        // Adăugăm în listă 
        listaActivitati.appendChild(elementNou);

        // Golim câmpul de input 
        inputActivitate.value = "";
    } else {
        alert("Te rog introdu o activitate!");
    }
});