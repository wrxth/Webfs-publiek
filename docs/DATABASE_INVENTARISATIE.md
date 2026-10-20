# Database-inventarisatie

## Oude structuur (afgeleid)

De volledige oude SQL-structuur is niet aanwezig in deze repository. De volgende onderdelen zijn wel aantoonbaar herleid uit seeders en legacy-assets:

- menucategorieen
- menunummers en suffixen zoals `14A`, `R1`, `P1`
- prijzen en beschrijvingen
- PDF-menukaart als referentie

## Nieuwe Laravel migrations

Belangrijkste tabellen:

- `menu_categories`
- `menu_items`
- `rice_options`
- `restaurant_tables`
- `table_sessions`
- `orders`
- `order_items`
- `offers`
- `menu_item_offer`
- `help_requests`
- `cms_pages`
- `reviews`
- standaard Laravel tabellen voor users, cache en jobs

## Nieuwe entiteiten/modellen

- `MenuCategory`
- `MenuItem`
- `RiceOption`
- `RestaurantTable`
- `TableSession`
- `Order`
- `OrderItem`
- `Offer`
- `HelpRequest`
- `CmsPage`
- `Review`

## Relaties

- `menu_categories` 1-n `menu_items`
- `offers` n-m `menu_items`
- `restaurant_tables` 1-n `table_sessions`
- `table_sessions` 1-n `orders`
- `orders` 1-n `order_items`
- `orders` 1-1 `reviews`
- `order_items` n-1 `menu_items`
- `order_items` n-1 `rice_options`
- `help_requests` n-1 `table_sessions`

## Keuzes voor nieuwe functionaliteit

- Bestellingen zijn genormaliseerd naar `orders` en `order_items`.
- Rijst-/bami-keuzes zijn aparte records geworden voor hergebruik in website, tablet en kassa.
- Aanbiedingen zijn relationeel gekoppeld aan meerdere menu-items.
- Reviews zijn los opgeslagen zodat klantfeedback traceerbaar blijft per order.

## Wat gaat van oud naar nieuw

- Oude categorieen -> `menu_categories`
- Oude gerechten -> `menu_items`
- Legacy menustructuur -> zichtbaar in publieke menukaart

Nieuwe data die pas in Laravel ontstaat:

- bestellingen
- orderregels
- reviews
- hulpvragen
- tafelsessies

## Aannames

- De seeders representeren de belangrijkste oude menucontent.
- Niet alle oude tabellen zijn terug te leiden, omdat de originele SQL-dump niet is meegeleverd.
- Voor ontbrekende historische tabellen is gekozen om alleen aantoonbaar benodigde data opnieuw op te bouwen.
