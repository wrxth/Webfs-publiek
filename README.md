# De Gouden Draak

Laravel 13 + Vue 3 migratie van de oude WEBFS-site van De Gouden Draak. De klassieke rood/gouden uitstraling is behouden, terwijl de applicatie technisch is voorbereid op OTAP, lokale Docker-ontwikkeling en shared hosting zonder SSH.

## Stack

- Laravel 13
- Vue 3 + Vite
- PHP 8.3
- Apache
- MySQL 8.x
- phpMyAdmin

## Snel starten

1. Kopieer de lokale configuratie:

```bash
cp .env.example .env
```

2. Start Docker:

```bash
docker compose up -d --build
```

3. Installeer PHP dependencies in de app-container:

```bash
docker compose exec app composer install
docker compose exec app php artisan key:generate
```

4. Installeer front-end dependencies op je host:

```bash
npm install
npm run build
```

5. Maak de database klaar:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

6. Open de applicatie:

- Website: `http://localhost:8080`
- phpMyAdmin: `http://localhost:8081`

## Testomgeving lokaal

Gebruik voor tests een aparte MySQL database.

```bash
cp .env.testing.example .env.testing
docker compose exec mysql mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS gouden_draak_test;"
docker compose exec app php artisan test
```

## Belangrijkste routes

- `/` homepage
- `/menu` menukaart met database-items, favorieten en actieve aanbiedingen
- `/aanbiedingen` publieke aanbiedingen
- `/bestellen` afhaal- en bezorgbestellingen
- `/kassa` desktop kassa/POS
- `/admin` beheer van tafels, menu-items en aanbiedingen
- `/tablet/{tableSession}` tabletflow per tafel
- `/review/{order}` reviewformulier na bestelling

## Functionaliteit

- Bezoekers:
  - publieke homepage, nieuws, contact en menukaart
  - favorieten opslaan in de browser
  - afhaal- en bezorgbestelling plaatsen
  - QR/orderoverzicht en reviewflow na bestelling
- Restaurant/tablet:
  - tafels openen
  - rondebestellingen plaatsen
  - herhaalbestellingen uit historie
  - hulpvraag naar backoffice
- Kassa:
  - live zoeken op naam, nummer en categorie
  - opmerkingen per regel
  - rijst-/bami-keuze per regel
- Admin:
  - menu-items beheren
  - aanbiedingen beheren
  - tafels openen/sluiten
  - hulpvragen afhandelen

## Handige commando's

```bash
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app php artisan test
npm install
npm run build
```

## Troubleshooting

- `Composer detected issues in your platform`: gebruik de Docker container met PHP 8.3 voor Composer en Artisan.
- `SQLSTATE[HY000] [1049] Unknown database 'gouden_draak_test'`: maak de testdatabase eerst aan via MySQL of phpMyAdmin.
- `Vite manifest not found`: voer `npm run build` opnieuw uit.
- Blanco pagina in Apache: controleer of de document root naar Laravel `public/` wijst.
- Rechtenproblemen: controleer schrijfpermissies op `storage/` en `bootstrap/cache/`.

## OTAP en documentatie

- [docs/OTAP.md](docs/OTAP.md)
- [docs/SERVERCONFIGURATIE.md](docs/SERVERCONFIGURATIE.md)
- [docs/MIGRATIEPLAN.md](docs/MIGRATIEPLAN.md)
- [docs/DATABASE_INVENTARISATIE.md](docs/DATABASE_INVENTARISATIE.md)
- [docs/USERSTORIES.md](docs/USERSTORIES.md)
- [FUNCTIONALITEITEN_CHECK.md](FUNCTIONALITEITEN_CHECK.md)

## Verificatie

De volgende commando's zijn bedoeld als standaard oplevercheck en zijn in deze README opgenomen zodat OTAP en productievoorbereiding herhaalbaar blijven:

```bash
npm run build
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app php artisan test
```
