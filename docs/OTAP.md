# OTAP De Gouden Draak

## Doel

Deze OTAP-opzet zorgt dat de Laravel/Vue applicatie lokaal reproduceerbaar draait met PHP 8.3, Apache, MySQL en phpMyAdmin, terwijl productie uitgaat van shared hosting zonder SSH.

## Ontwikkelomgeving

- Docker Compose start drie services:
  - `app`: PHP 8.3 + Apache
  - `mysql`: MySQL 8.x
  - `phpmyadmin`: beheer van database via browser
- Apache wijst naar Laravel `public/` via `docker/apache/000-default.conf`.
- Composer draait in de app-container:

```bash
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed
```

- Node/npm/Vite draaien op de host:

```bash
npm install
npm run build
```

- Handige Laravel-commando's:
  - `docker compose exec app php artisan route:list`
  - `docker compose exec app php artisan migrate:fresh --seed`
  - `docker compose exec app php artisan test`

## Testomgeving

- Gebruik `APP_ENV=testing`.
- Gebruik een aparte database, bijvoorbeeld `gouden_draak_test`.
- Voorbeeldconfiguratie staat in `.env.testing.example`.
- Maak de testdatabase eenmalig aan:

```bash
docker compose exec mysql mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS gouden_draak_test;"
```

- Voer tests uit met:

```bash
docker compose exec app php artisan test
```

- Gebruik `migrate:fresh` en eventueel `--seed` om reproduceerbare testdata te krijgen.

## Acceptatieomgeving

- Zelfde stack als productie:
  - PHP 8.3
  - Apache + `mod_rewrite`
  - MySQL/MariaDB
- Gebruik representatieve data:
  - gemigreerde menukaart
  - aanbiedingen
  - voorbeeld tafels/sessies
- Acceptatietests door opdrachtgever:
  - menu bekijken
  - aanbieding bekijken
  - bestelling plaatsen
  - tabletbestelling plaatsen
  - admin beheer van menu-items en aanbiedingen

## Productieomgeving

- Shared hosting met:
  - Apache
  - PHP 8.3
  - MySQL of MariaDB
  - phpMyAdmin
- Geen SSH beschikbaar.
- Deploy via control panel of bestandsupload.
- Database import via phpMyAdmin.
- Laravel `public/` moet de document root zijn.
- Schrijfbare mappen:
  - `storage/`
  - `bootstrap/cache/`

## Deployproces

1. Ontwikkelen in lokale Docker-omgeving.
2. Front-end builden met `npm run build`.
3. Migrations en seeders lokaal draaien.
4. Feature tests uitvoeren.
5. Acceptatieomgeving bijwerken met releasekandidaat.
6. Database-export en bestandsbackup maken voor productie.
7. Migratiepad en imports controleren.
8. Onderhoudsmoment afspreken.
9. Productie live zetten via bestandsupload en `.env` configuratie.
10. Databasewijzigingen uitvoeren via phpMyAdmin of via vooraf getest artisan-commando in een tijdelijke lokale kopie.

## Rollback-plan

1. Maak voor livegang een export van de productie-database.
2. Bewaar het vorige releasepakket van bestanden.
3. Bij mislukte release:
   - zet vorige bestanden terug
   - importeer databasebackup via phpMyAdmin
   - controleer homepage, menu en bestelflow
4. Documenteer welke migratie of import is teruggedraaid.
