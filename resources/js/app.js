import { createApp } from 'vue';
import OrderBuilder from './components/OrderBuilder.vue';
import PosSearch from './components/PosSearch.vue';
import MenuFavorites from './components/MenuFavorites.vue';

const orderBuilder = document.getElementById('vue-order-builder');
if (orderBuilder) {
    createApp(OrderBuilder, {
        items: JSON.parse(orderBuilder.dataset.items),
        riceOptions: JSON.parse(orderBuilder.dataset.riceOptions),
        orderHistory: JSON.parse(orderBuilder.dataset.orderHistory ?? '[]'),
    }).mount(orderBuilder);
}

const posSearch = document.getElementById('vue-pos-search');
if (posSearch) {
    createApp(PosSearch, {
        searchUrl: posSearch.dataset.searchUrl,
        categories: JSON.parse(posSearch.dataset.categories ?? '[]'),
        riceOptions: JSON.parse(posSearch.dataset.riceOptions ?? '[]'),
        noteSuggestions: JSON.parse(posSearch.dataset.noteSuggestions ?? '[]'),
    }).mount(posSearch);
}


const menuFavorites = document.getElementById('vue-menu-favorites');
if (menuFavorites) {
    createApp(MenuFavorites, {
        items: JSON.parse(menuFavorites.dataset.items),
    }).mount(menuFavorites);
}
