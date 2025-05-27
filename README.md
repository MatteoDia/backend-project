# Backend Project

Een website gemaakt met Laravel 12 voor het vak Backend Web.

## Vereisten
- PHP 8.2 of hoger
- Composer
- MySQL
- Node.js en NPM

## GitHub Repository
[Link naar mijn GitHub repository](https://github.com/MatteoDia/backend-project.git)

## Wat kan je doen op de website?

### Gebruikers
- Inloggen en registreren
- Je eigen profiel aanpassen
- Admins kunnen andere gebruikers beheren

### Nieuws
- Nieuws bekijken
- Admins kunnen nieuws toevoegen, aanpassen en verwijderen
- Foto's bij nieuwsberichten plaatsen

### FAQ (Veel gestelde vragen)
- Vragen en antwoorden bekijken
- Admins kunnen categorieën en vragen beheren

### Contact
- Contactformulier invullen
- Admins krijgen een e-mail bij nieuwe berichten
- Admins kunnen berichten beheren

## Hoe installeer je het project?

1. Open een terminal en typ:
```bash
composer install
```

2. Kopieer het .env.example bestand naar .env:
```bash
copy .env.example .env
```

3. Maak een nieuwe database aan in phpMyAdmin

4. Pas het .env bestand aan met je database gegevens:
```
DB_DATABASE=jouw_database_naam
DB_USERNAME=jouw_gebruikersnaam
DB_PASSWORD=jouw_wachtwoord
```

5. Genereer een nieuwe app key:
```bash
php artisan key:generate
```

6. Maak de database tabellen aan:
```bash
php artisan migrate:fresh --seed
```

7. Start de server:
```bash
php artisan serve
```

## Admin Account

Om in te loggen als admin:
- E-mail: admin@ehb.be
- Wachtwoord: Password!321

## Hoe is het project opgebouwd?

- `app/Models/` - Database modellen
- `app/Http/Controllers/` - Controllers voor de website logica
- `database/migrations/` - Database structuur
- `resources/views/` - Website pagina's
- `routes/web.php` - Website routes
