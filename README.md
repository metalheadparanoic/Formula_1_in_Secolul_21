# Formula 1 în Secolul 21 - Website Interactiv

## Descriere Proiect

Website dedicat Formulei 1 moderne, care oferă informații complete despre piloți, echipe, calendarul curselor și statistici istorice. Proiectul include funcționalități de autentificare, panou admin și acces VIP pentru conținut exclusiv.

## Tehnologii Utilizate

### Frontend
- **HTML5** - Structură semantică
- **CSS3** - Stilizare modernă cu:
  - Grid Layout pentru structura paginilor
  - Flexbox pentru componente
  - Animații și tranziții
  - Design responsive (mobile-first)
  - Unități relative (rem, em, %, vw)
- **JavaScript (Vanilla)** - Funcționalități interactive:
  - Cronometru live pentru următoarea cursă
  - Filtru live pentru căutare piloți
  - Buton "Scroll to Top"
  - Validări și interacțiuni dinamice

### Backend
- **PHP 8.x** - Logică server-side
- **MySQL/MariaDB** - Bază de date
- **PDO** - Conexiuni securizate la baza de date
- **Sessions** - Gestionare autentificare

### Infrastructură
- **Docker** - Containerizare aplicație
- **LAMP Stack** (Linux, Apache, MySQL, PHP)

## Structura Proiectului

```
studenti/
├── index.php              # Pagina principală
├── piloti.php            # Lista piloților sezonului 2025
├── echipe.php            # Echipe și constructori
├── calendar.php          # Calendarul curselor 2025
├── arhiva.php            # Arhiva sezoanelor istorice (2001-2024)
├── paddock.php           # Zonă VIP (necesită autentificare)
├── login.php             # Autentificare utilizatori
├── register.php          # Înregistrare cont nou
├── logout.php            # Deconectare
├── admin.php             # Panou admin - gestionare curse
├── admin_users.php       # Panou admin - gestionare utilizatori
├── header.php            # Header & navigație (componentă reutilizabilă)
├── footer.php            # Footer (componentă reutilizabilă)
├── db.php                # Conexiune bază de date
├── setup_db.php          # Script inițializare tabele
├── test_db.php           # Test conexiune DB
├── stil_general.css      # Stiluri globale
├── style_homepage.css    # Stiluri homepage
├── style_piloti.css      # Stiluri pagină piloți
├── style_echipe.css      # Stiluri pagină echipe
├── style_calendar.css    # Stiluri calendar curse
├── f1_style.css          # Stiluri login/register
├── script.js             # JavaScript principal
└── imagini/              # Resurse media (poze piloți, mașini, circuite)
```

## Structura Bazei de Date

### Tabele Principale

**1. users** - Conturi utilizatori
- `id` (PRIMARY KEY)
- `username` (UNIQUE)
- `password` (hash bcrypt)
- `created_at`

**2. history_seasons** - Sezoane istorice
- `year` (PRIMARY KEY)
- `description`
- `champion_driver`
- `champion_team`
- `car_image`

**3. history_races** - Curse istorice
- `id` (PRIMARY KEY)
- `year` (FOREIGN KEY → history_seasons)
- `round`, `circuit`, `date`
- `winner`, `team`, `laps`, `time`

**4. history_standings** - Clasament piloți istoric
- `year` (FOREIGN KEY → history_seasons)
- `position`, `driver_name`, `team_name`, `points`

**5. history_constructors** - Clasament constructori istoric
- `year` (FOREIGN KEY → history_seasons)
- `position`, `team_name`, `points`

## Funcționalități Principale

### Pentru Utilizatori Obișnuiți
✅ Vizualizare piloți și echipe sezonului 2025
✅ Calendar complet cu 24 de cursă (cu animații specifice fiecărei țări)
✅ Filtru live de căutare piloți
✅ Cronometru până la următoarea cursă
✅ Arhivă completă sezoane 2001-2024 cu statistici
✅ Design responsive (desktop, tabletă, mobile)
✅ Buton "Scroll to Top" pe toate paginile

### Pentru Utilizatori Autentificați
Acces la **Paddock Club VIP**
Conținut exclusiv și informații suplimentare
Profil personalizat cu nume utilizator

### Pentru Administratori
**Admin Curse** - Gestionare date istorice:
- Adăugare/editare sezoane
- Adăugare curse noi
- Actualizare clasamente
- Ștergere date

**Admin Utilizatori**:
- Vizualizare toți utilizatorii
- Ștergere conturi
- Gestionare acces

## Securitate

- **Parolele sunt criptate** cu `password_hash()` (bcrypt)
- **Verificare sesiuni** pe paginile protejate
- **Prepared statements (PDO)** pentru prevenirea SQL Injection
- **Validare input** pe toate formularele
- **Roluri utilizator** (user normal / admin)

## Cerințe de Accesibilitate & Usability

✅ **Contrast bun** - Text alb pe fundal negru (#FFFFFF pe #121212)
✅ **Unități relative** - folosire rem/em în loc de px
✅ **Imagini responsive** - `max-width: 100%`, `height: auto`
✅ **Navigare intuitivă** - meniu sticky, breadcrumbs
✅ **Feedback vizual** - animații hover, tranziții smooth
✅ **Favicon** pe toate paginile
✅ **Mobile-friendly** - design responsive cu media queries

## Instalare și Rulare

### Prerequisite
- Docker & Docker Compose
- Browser modern (Chrome, Firefox, Edge)

### Pași Instalare

1. **Clonare repository**
```bash
git clone <repository-url>
cd studenti
```

2. **Start Docker containers**
```bash
docker-compose up -d
```

3. **Inițializare bază de date**
- Accesați: `http://localhost:8888/setup_db.php`
- Verificați mesajele de succes pentru toate tabelele

4. **Test conexiune**
- Accesați: `http://localhost:8888/test_db.php`

5. **Acces aplicație**
- **Homepage**: `http://localhost:8888/index.php`
- **Login**: `http://localhost:8888/login.php`

### Cont Admin Implicit
- **Username**: `admin`
- **Password**: `admin123` (sau conform bazei de date)

## 📱 Pagini Disponibile

| Pagină | URL | Descriere | Acces |
|--------|-----|-----------|-------|
| Homepage | `/index.php` | Pagina principală cu hero section | Public |
| Piloți | `/piloti.php` | Lista completă piloți 2025 | Public |
| Echipe | `/echipe.php` | Toate echipele F1 2025 | Public |
| Calendar | `/calendar.php` | Calendarul curselor 2025 | Public |
| Arhivă | `/arhiva.php` | Istorie F1 2001-2024 | Public |
| Paddock Club | `/paddock.php` | Zonă VIP exclusivă | Autentificat |
| Login | `/login.php` | Autentificare | Public |
| Register | `/register.php` | Creare cont | Public |
| Admin Curse | `/admin.php` | Gestionare curse | Admin |
| Admin Users | `/admin_users.php` | Gestionare utilizatori | Admin |

## Paleta de Culori

- **Roșu F1**: `#FF0000` / `#E10600` - Accent principal
- **Negru**: `#121212` / `#1A1A1A` - Background
- **Alb**: `#FFFFFF` - Text principal
- **Gri**: `#333333` / `#555555` - Bordere și elemente secundare
- **Culori echipe**: McLaren (portocaliu), Ferrari (roșu), Mercedes (turcoaz), etc.

## Autor

**Tudor** - Student, Universitatea Politehnica București
- Facultatea: [Facultatea]
- An: 3, Semestrul 1
- Disciplina: Tehnologii Web (TW)

## Notițe Importante

- Proiectul folosește **Docker** pentru portabilitate
- Toate datele sunt **persistente** (volumuri Docker)
- **Setup-ul inițial** necesită rularea `setup_db.php`
- Pentru **dezvoltare locală** fără Docker, ajustați `db.php` (host: `localhost`)

## Dezvoltări Viitoare

- [ ] API REST pentru datele F1
- [ ] WebSocket pentru live timing în cursă
- [ ] Sistem de comentarii pentru utilizatori
- [ ] Grafice interactive pentru statistici
- [ ] Export PDF pentru clasamente
- [ ] Integrare OAuth (Google, Facebook)
- [ ] PWA (Progressive Web App)

## Licență

Acest proiect este realizat în scop educativ pentru cursul de Tehnologii Web.

---

**🏁 Enjoy the race! 🏁**
