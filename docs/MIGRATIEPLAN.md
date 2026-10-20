# Migratieplan oude data

## Bronsituatie

De oude WEBFS-site gebruikte een klassieke menustructuur met gerechten, categorieen, PDF-menukaarten en statische content. De originele SQL-dump staat niet meer in deze repository, maar de aangetroffen inhoud is opnieuw opgebouwd in:

- `database/seeders/OldWebfsSeeder.php`
- `public/legacy-assets/menukaarten/`
- `public/legacy-assets/pictures/`

## Aangetroffen data

Op basis van de seeders en legacy-bestanden zijn minimaal deze datasets herleid:

- menucategorieen
- menu-items met nummer/suffix/prijs
- rijstopties
- basis aanbiedingen
- restauranttafels

## Overzet naar Laravel datamodel

- Oude categorieen -> `menu_categories`
- Oude gerechten -> `menu_items`
- Oude rijst/bami keuzes -> `rice_options`
- Nieuwe acties -> `offers` + `menu_item_offer`
- Nieuwe bestellingen -> `orders` + `order_items`
- Reviews -> `reviews`

## Import- en seedstrategie

1. Start met lege database.
2. Draai alle Laravel migrations.
3. Draai `DatabaseSeeder`.
4. `OldWebfsSeeder` vult de herstelde oude menustructuur.
5. Demo-aanbiedingen en tafels worden aanvullend gevuld.

## Behoud van oude content

- Menu-items en categorieen blijven behouden via `OldWebfsSeeder`.
- Legacy PDF-menukaarten blijven beschikbaar als referentie/download.
- Aanbiedingen worden nu als aparte relationele data opgeslagen.

## OTAP-moment van migratie

- Ontwikkel: seeders lokaal testen en mappings verfijnen.
- Test: import herhalen in aparte testdatabase.
- Acceptatie: import uitvoeren met representatieve data voor controle.
- Productie: definitieve export/import tijdens onderhoudsmoment.

## Controle op dataverlies

Controleer minimaal:

- aantal categorieen en menu-items
- steekproef van prijzen, nummers en suffixen
- zichtbaarheid op `/menu`
- koppeling van aanbiedingen aan gerechten
- of bestellingen, orderregels en reviews na livegang correct opslaan

## Productie-import zonder SSH

Omdat productie geen SSH heeft:

- database import via phpMyAdmin
- releasebestanden uploaden via control panel of FTP
- `.env` handmatig instellen in hostingomgeving

## Rollback

1. Maak SQL-export voor livegang.
2. Bewaar vorig releasepakket.
3. Mislukt de migratie, herstel:
   - vorige bestanden
   - vorige database-export via phpMyAdmin
4. Hercontroleer homepage, menu, aanbiedingen en bestellen.
