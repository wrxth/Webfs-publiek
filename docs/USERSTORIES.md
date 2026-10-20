# Userstories De Gouden Draak

Bron voor nieuwe functionaliteit: `../WEBFS - Nieuwe Functionaliteit v2.xlsx`

Statuswaarden:

- `Gebouwd`
- `Deels gebouwd`
- `Ontbreekt`
- `Buiten scope / later`

## Bestaande/overgenomen functionaliteit

| Story | Beschrijving | Acceptatiecriteria | Status |
| --- | --- | --- | --- |
| LEG-1 | Als bezoeker wil ik een herkenbare homepage zien zodat het restaurant direct herkenbaar is | Klassieke huisstijl, navigatie en branding zichtbaar | Gebouwd |
| LEG-2 | Als bezoeker wil ik de menukaart kunnen bekijken zodat ik gerechten kan kiezen | Menukaart laadt uit database en legacy PDF blijft beschikbaar | Gebouwd |
| LEG-3 | Als bezoeker wil ik aanbiedingen kunnen bekijken zodat ik weekacties zie | Aanbiedingenpagina en menublok tonen actuele acties | Gebouwd |
| LEG-4 | Als beheerder wil ik oude menu-inhoud behouden zodat er geen historische data verloren gaat | Seeders vullen categorieen, gerechten en rijstopties opnieuw | Gebouwd |

## Nieuwe functionaliteit uit Excel

### Restaurant (Tablet view)

| ID | Story | Acceptatiecriteria | Status | Toelichting |
| --- | --- | --- | --- | --- |
| US-1 | Als klant wil ik een bestelling kunnen maken aan mijn tafel via een tablet | Tafelindicatie aanwezig, max 1x per 10 min, max 5 rondes | Gebouwd | Tabletflow en validatie aanwezig |
| US-2 | Als ober wil ik bezoekers registreren bij een tafel | Max 8 personen, leeftijden, deluxe ja/nee | Gebouwd | Admin dashboard ondersteunt dit |
| US-3 | Als ober wil ik de rekening opdelen | Max 8 delen, producten per deel koppelbaar | Ontbreekt | Geen split-bill logica |
| US-4 | Als ober wil ik de rekening als PDF opslaan | Leesbare PDF-bon met meerdere pagina's | Ontbreekt | Nog geen bon/PDF module |
| US-5 | Als klant wil ik hulp kunnen inschakelen en als ober wil ik hulpvragen zien | Backoffice melding en afhandelactie | Gebouwd | Hulpvragen zichtbaar op admin dashboard |
| US-6 | Als klant wil ik een herhalingsbestelling kunnen doen | Hele vorige bestelling of losse regels opnieuw toevoegen | Gebouwd | Bestelhistorie in Vue tabletflow |
| US-7 | Als klant wil ik cocktailinspiratie zien | API, afbeeldingen, zoek/filter | Buiten scope / later | Niet gebouwd |
| US-8 | De rekening bevat een QR-code naar een responsive reviewformulier | Interactief reviewformulier met meerdere vragen | Deels gebouwd | Reviewflow en QR naar review bestaan, geen complete rekeningmodule |

### Kassa (voor afhaal) (Desktop view)

| ID | Story | Acceptatiecriteria | Status | Toelichting |
| --- | --- | --- | --- | --- |
| US-9 | Als kassamedewerker wil ik eenvoudig gerechten opzoeken | Zoekfunctie op naam/nummer en filter op categorie | Gebouwd | Vue POS aanwezig |
| US-10 | Als kassamedewerker wil ik opmerkingen per gerecht toevoegen | Vrije opmerking + veelgebruikte suggesties uit database | Gebouwd | Suggesties op basis van orderhistorie |
| US-11 | Als kassamedewerker wil ik per gerecht rijstkeuze aangeven | Witte rijst, nasi/bami, mihoen, Chinese bami per regel | Gebouwd | Regels zijn los op te bouwen |
| US-12 | Als kassamedewerker wil ik aanbiedingen invoeren | Aanbiedingen zichtbaar op aparte pagina en op menu | Gebouwd | Volledige CRUD en publieke weergave |

### Website

| ID | Story | Acceptatiecriteria | Status | Toelichting |
| --- | --- | --- | --- | --- |
| UC-13 | Als klant wil ik de site in een passende taal lezen | NL/EN wissel en basis accessibility-checks | Ontbreekt | Geen i18n-switch aanwezig |
| UC-14 | Als klant wil ik een up-to-date PDF van het menu downloaden | PDF vanuit database, acties op aparte pagina | Deels gebouwd | Legacy PDF beschikbaar, nog geen nieuwe generatie |
| UC-15 | Als klant wil ik favoriete gerechten kunnen aanvinken | Favorieten bovenaan of alleen favorieten alfabetisch | Gebouwd | LocalStorage + sorteren aanwezig |
| UC-16 | Als klant wil ik via de website een afhaalbestelling doorgeven | Bedanktpagina met QR, bestelnummer en gerechten | Gebouwd | Bestelflow, QR-overzicht en reviewlink aanwezig |
| WEB-RWD | De website is responsive op drie schermgroottes | Layout blijft bruikbaar mobiel/tablet/desktop | Deels gebouwd | Basis responsive styling aanwezig, geen aparte formele audit |

### Admin

| ID | Story | Acceptatiecriteria | Status | Toelichting |
| --- | --- | --- | --- | --- |
| UC-17 | Als eigenaar wil ik een planning kunnen maken | Medewerkers aan meerdere tafels koppelen | Deels gebouwd | Tafelregistratie bestaat, personeelsplanning niet |
| UC-18 | Er is een CMS systeem voor menu/extra pagina's | Extra pagina's met vaste layout/WYSIWYG | Deels gebouwd | `cms_pages` bestaat, geen complete beheer-UI |
| UC-19 | Als admin wil ik dagelijks omzetoverzicht in Excel | Scheduler + downloadbare samenvatting | Buiten scope / later | Niet gebouwd |
| UC-20 | Als admin wil ik gerechten toevoegen, aanpassen en verwijderen | Nummering blijft bruikbaar met suffixen | Gebouwd | Volledige menu-item CRUD |

## Minimaal twee uitgewerkte features per categorie

- Restaurant:
  - US-1 tabletbestelling
  - US-6 herhaalbestelling
- Kassa:
  - US-9 live zoeken/filteren
  - US-10 opmerkingen en suggesties
- Website:
  - UC-15 favorieten
  - UC-16 online bestellen + QR
- Admin:
  - UC-20 menu-item CRUD
  - US-12 aanbiedingen beheren
