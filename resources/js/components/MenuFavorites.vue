<template>
    <div class="paper-card">
        <div class="toolbar">
            <label style="min-width:260px">Zoek gerecht
                <input v-model="query" placeholder="Naam, nummer of categorie">
            </label>

            <label style="min-width:220px">Weergave
                <select v-model="mode">
                    <option value="all">Hele menu</option>
                    <option value="favorites">Alleen favorieten</option>
                </select>
            </label>

            <label style="min-width:240px">Sorteer favorieten
                <select v-model="favoriteSort">
                    <option value="number">Op gerechtnummer</option>
                    <option value="alphabetical">Alfabetisch</option>
                </select>
            </label>

            <button type="button" class="btn secondary" @click="clearFavorites" :disabled="favoriteIds.length === 0">Favorieten wissen</button>
        </div>

        <div v-if="visibleFavorites.length > 0" class="summary" style="margin-bottom:12px">
            <strong>Favorieten bovenaan</strong><br>
            <span class="muted">Deze lijst volgt {{ favoriteSortLabel }}. De rest van het menu blijft in de bestaande menuvolgorde staan.</span>
        </div>

        <table>
            <tr><th>Fav</th><th>Nr</th><th>Gerecht</th><th>Prijs</th></tr>
            <tr v-for="item in visibleItems" :key="item.id">
                <td style="width:90px">
                    <button
                        type="button"
                        class="btn secondary"
                        :aria-label="isFavorite(item.id) ? 'Verwijder favoriet' : 'Maak favoriet'"
                        @click="toggleFavorite(item.id)"
                    >
                        {{ isFavorite(item.id) ? '★' : '☆' }}
                    </button>
                </td>
                <td style="width:80px">{{ formatMenuNumber(item) }}</td>
                <td>
                    <strong>{{ item.name }}</strong>
                    <span class="pill" v-if="isFavorite(item.id)">Favoriet</span>
                    <br><span class="muted">{{ item.category?.name ?? '' }}</span>
                </td>
                <td class="price">{{ money(item.price) }}</td>
            </tr>
            <tr v-if="visibleItems.length === 0"><td colspan="4">Geen gerechten gevonden.</td></tr>
        </table>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from 'vue';

const STORAGE_KEY = 'gdraak-favorites';

const props = defineProps({ items: { type: Array, required: true } });

const query = ref('');
const mode = ref('all');
const favoriteSort = ref('number');
const favoriteIds = ref([]);

onMounted(() => {
    try {
        const parsed = JSON.parse(localStorage.getItem(STORAGE_KEY) ?? '[]');
        favoriteIds.value = Array.isArray(parsed)
            ? parsed.map((id) => Number.parseInt(id, 10)).filter((id) => Number.isFinite(id))
            : [];
    } catch {
        favoriteIds.value = [];
    }
});

watch(favoriteIds, () => {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(favoriteIds.value));
}, { deep: true });

const normalizedItems = computed(() => props.items.map((item, index) => ({
    ...item,
    _originalIndex: index,
})));

const filteredItems = computed(() => {
    const q = query.value.trim().toLowerCase();

    return normalizedItems.value.filter((item) => {
        if (mode.value === 'favorites' && !isFavorite(item.id)) {
            return false;
        }

        if (!q) {
            return true;
        }

        return String(item.name ?? '').toLowerCase().includes(q)
            || String(item.number ?? '').includes(q)
            || String(item.suffix ?? '').toLowerCase().includes(q)
            || String(item.category?.name ?? '').toLowerCase().includes(q);
    });
});

const visibleFavorites = computed(() => sortFavoriteItems(
    filteredItems.value.filter((item) => isFavorite(item.id)),
));

const visibleNonFavorites = computed(() => filteredItems.value
    .filter((item) => !isFavorite(item.id))
    .sort((a, b) => a._originalIndex - b._originalIndex));

const visibleItems = computed(() => {
    if (mode.value === 'favorites') {
        return visibleFavorites.value;
    }

    return [...visibleFavorites.value, ...visibleNonFavorites.value];
});

const favoriteSortLabel = computed(() => favoriteSort.value === 'alphabetical' ? 'alfabetische volgorde' : 'geselecteerde gerechtnummers');

function sortFavoriteItems(items) {
    const sorted = [...items];

    if (favoriteSort.value === 'alphabetical') {
        return sorted.sort((a, b) => String(a.name ?? '').localeCompare(String(b.name ?? ''), 'nl'));
    }

    return sorted.sort((a, b) => compareMenuNumber(a, b));
}

function compareMenuNumber(a, b) {
    const numberA = Number.isFinite(Number(a.number)) ? Number(a.number) : Number.MAX_SAFE_INTEGER;
    const numberB = Number.isFinite(Number(b.number)) ? Number(b.number) : Number.MAX_SAFE_INTEGER;

    if (numberA !== numberB) {
        return numberA - numberB;
    }

    return String(a.suffix ?? '').localeCompare(String(b.suffix ?? ''), 'nl');
}

function formatMenuNumber(item) {
    return `${item.number ?? ''}${item.suffix ?? ''}` || '-';
}

function isFavorite(id) {
    return favoriteIds.value.includes(id);
}

function toggleFavorite(id) {
    favoriteIds.value = isFavorite(id)
        ? favoriteIds.value.filter((itemId) => itemId !== id)
        : [...favoriteIds.value, id];
}

function clearFavorites() {
    favoriteIds.value = [];
}

function money(value) {
    return new Intl.NumberFormat('nl-NL', { style: 'currency', currency: 'EUR' }).format(Number(value) || 0);
}
</script>
