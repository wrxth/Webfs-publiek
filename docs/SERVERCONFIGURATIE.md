# Serverconfiguratie De Gouden Draak

## Minimale software

- PHP 8.3
- Apache met `mod_rewrite`
- MySQL 8.x of compatibele MariaDB/shared-hosting variant
- Composer 2.x
- Node.js 20+ en npm voor lokale/acceptatie buildstap

## PHP-extensies

Benodigd voor Laravel en deze applicatie:

- `bcmath`
- `ctype`
- `exif`
- `fileinfo`
- `gd`
- `json`
- `mbstring`
- `openssl`
- `pdo_mysql`
- `tokenizer`
- `xml`
- `zip`

## Apache

- Document root moet naar Laravel `public/` wijzen.
- `AllowOverride All` moet actief zijn voor `.htaccess`.
- `mod_rewrite` moet ingeschakeld zijn.

## Rechten

- `storage/` moet schrijfbaar zijn voor de webserver.
- `bootstrap/cache/` moet schrijfbaar zijn voor de webserver.

## .env instellingen

Belangrijkste productie-instellingen:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://jouwdomein.nl`
- `DB_CONNECTION=mysql`
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `CACHE_STORE=database`
- `SESSION_DRIVER=database`
- `QUEUE_CONNECTION=database` of `sync` op eenvoudige shared hosting
- `LOG_CHANNEL=stack`
- `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`

## Mail, log, cache en sessies

- Mail:
  - gebruik SMTP van hostingpartij of externe mailprovider
- Logging:
  - standaard via Laravel logbestand in `storage/logs/`
- Cache:
  - databasecache is het eenvoudigst op shared hosting
- Sessies:
  - database of file; database is consistenter bij meerdere processen

## Opslagruimte-inschatting

- Applicatiecode: laag tot gemiddeld
- `vendor/` en front-end build: gemiddeld
- Database: laag tot gemiddeld, groeit mee met orders/reviews
- Backups en exports: extra ruimte reserveren voor SQL dumps en releasepakketten

## Verschil lokaal vs shared hosting

- Lokaal:
  - Docker
  - aparte services voor Apache, MySQL en phpMyAdmin
  - volledige controle over PHP-versie
- Shared hosting:
  - geen SSH
  - deploy via upload/control panel
  - databasebeheer via phpMyAdmin
  - afhankelijk van hostinginstellingen voor modules en rechten
