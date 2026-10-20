# Functionele checklijst De Gouden Draak

| Functionaliteit | Route/pagina | Status | Teststappen | Acceptatiecriteria | Opmerkingen |
| --- | --- | --- | --- | --- | --- |
| Homepage in restaurantstijl | `/` | Gebouwd | Open homepage | Pagina laadt, navigatie zichtbaar, klassieke stijl herkenbaar | Basis smoke test aanwezig |
| Menukaart bekijken en zoeken | `/menu` | Gebouwd | Zoek op naam, nummer en omschrijving | Gerecht verschijnt in juiste categorie | Zoekt nu ook in omschrijving |
| Favoriete gerechten | `/menu` | Gebouwd | Markeer favoriet, herlaad pagina | Favorieten blijven lokaal bewaard en sorteerbaar | Browser/localStorage |
| Actieve aanbiedingen bekijken | `/aanbiedingen`, `/menu` | Gebouwd | Open aanbiedingenpagina en menukaart | Actieve aanbiedingen zichtbaar op beide plekken | Alleen actuele, actieve aanbiedingen |
| Websitebestelling afhalen/bezorgen | `/bestellen` | Gebouwd | Plaats afhaal- en bezorgbestelling | Validatie werkt, order wordt opgeslagen, bedanktpagina verschijnt | Bezorging vereist adresvelden |
| QR/orderbon en reviewlink | `/bestellen/bedankt/{order}` | Gebouwd | Plaats bestelling en open bedanktpagina | QR met orderoverzicht zichtbaar, reviewlink aanwezig | Reviewformulier blijft aparte route |
| Tabletbestelling per tafel | `/tablet/{tableSession}` | Gebouwd | Open tafel, plaats ronde | Max 1 bestelling per 10 min, max 5 rondes | Gedekt met feature tests |
| Tablet hulpvraag | `/tablet/{tableSession}` + admin dashboard | Gebouwd | Klik "Roep bediening", open admin | Hulpvraag verschijnt en kan afgehandeld worden | Backoffice-overzicht aanwezig |
| Herhaalbestelling uit historie | `/tablet/{tableSession}` | Gebouwd | Plaats ronde, open opnieuw, herhaal regel/ronde | Vorige bestellingen kunnen opnieuw toegevoegd worden | Gedekt met feature test |
| Kassa live zoeken | `/kassa` | Gebouwd | Zoek op naam/nummer, filter op categorie | Resultaten updaten live | Vue-component gebruikt fetch |
| Kassabon met opmerkingen | `/kassa` | Gebouwd | Voeg item toe en vul opmerking in | Opmerking per regel zichtbaar | Suggesties uit eerdere orderitems |
| Rijst-/bami-keuze in kassa | `/kassa` | Gebouwd | Voeg regel toe en kies optie | Regeltotaal past zich aan | Valt onder Excel story US-11 |
| Admin menu-items beheren | `/admin/menu-items` | Gebouwd | Voeg item toe, wijzig, verwijder | CRUD werkt zonder kapotte routes | Nummer en suffix ondersteund |
| Admin aanbiedingen beheren | `/admin/offers` | Gebouwd | Voeg aanbieding toe, wijzig, verwijder | CRUD werkt, gekoppelde gerechten blijven intact | Nieuw uitgebreid naar volledige CRUD |
| Tafels openen/sluiten | `/admin` | Gebouwd | Registreer tafel, open tabletlink, sluit sessie | Open sessies en sluitactie werken | Gastaantal max 8 |
| Reviews ontvangen | `/review/{order}` | Gebouwd | Open reviewformulier en verstuur review | Scores en feedback worden opgeslagen | Meerdere vragen aanwezig |
| Database seeders met oude menudata | `php artisan migrate:fresh --seed` | Gebouwd | Draai migraties en seeders | Demo- en oude menucontent komen terug | Oude dataset via `OldWebfsSeeder` |
| Database-gegenereerde PDF van menu | n.v.t. | Deels gebouwd | Open PDF-links op menu | Downloadbare PDF aanwezig | Nu nog legacy PDF, geen nieuwe generatie |
| Lokalisatie NL/EN en accessibility-check | n.v.t. | Ontbreekt | n.v.t. | Geen taalwissel aanwezig | Bewust buiten huidige scope |
| Rekening opdelen / PDF-bon restaurant | n.v.t. | Ontbreekt | n.v.t. | Nog niet geïmplementeerd | Later indien gewenst |
| Dagelijkse Excel-omzetexport | n.v.t. | Buiten scope / later | n.v.t. | Geen scheduler/export aanwezig | Wel beschreven in userstories |
