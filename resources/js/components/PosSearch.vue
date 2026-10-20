<template>
    <div class="pos-shell">
        <div class="card pos-hero">
            <div class="pos-hero-metrics">
                <div class="summary">
                    <strong>{{ receipt.length }}</strong><br>
                    <span class="muted">Bonregels</span>
                </div>
                <div class="summary">
                    <strong>{{ money(total) }}</strong><br>
                    <span class="muted">Totaal</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="toolbar pos-toolbar">
                <label class="pos-toolbar-field pos-toolbar-search">
                    Zoek gerecht
                    <input v-model="query" type="search" placeholder="Bijv. 79, babi pangang of foe yong hai" autofocus>
                </label>

                <label class="pos-toolbar-field">
                    Categorie
                    <select v-model="selectedCategoryId">
                        <option value="">Alle categorieen</option>
                        <option v-for="category in categories" :key="category.id" :value="String(category.id)">
                            {{ category.name }}
                        </option>
                    </select>
                </label>

                <label class="pos-toolbar-field">
                    Standaard rijstkeuze
                    <select v-model="selectedRiceId">
                        <option value="">Kies bij toevoegen</option>
                        <option v-for="rice in riceOptions" :key="rice.id" :value="String(rice.id)">
                            {{ rice.name }} <template v-if="Number(rice.extra_price) > 0">(+ {{ money(rice.extra_price) }})</template>
                        </option>
                    </select>
                </label>

                <div class="actions">
                    <button type="button" class="btn secondary" @click="resetFilters">Reset filters</button>
                    <button type="button" class="btn secondary" @click="clearReceipt" :disabled="receipt.length === 0">Leeg kassabon</button>
                </div>
            </div>

            <p class="muted pos-search-status">
                <template v-if="loading">Zoeken...</template>
                <template v-else>{{ results.length }} gerechten gevonden</template>
            </p>
            <div v-if="errorMessage" class="alert error">{{ errorMessage }}</div>
        </div>

        <div class="grid pos-grid">
            <div class="card">
                <div class="actions" style="justify-content:space-between">
                    <h2>Zoekresultaten</h2>
                    <span class="pill" v-if="selectedCategoryName">{{ selectedCategoryName }}</span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Nr</th>
                            <th>Gerecht</th>
                            <th>Categorie</th>
                            <th>Prijs</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in results" :key="item.id" class="clickable-row" @click="addToReceipt(item)">
                            <td>{{ formatMenuNumber(item) }}</td>
                            <td>
                                <strong>{{ item.name }}</strong><br>
                                <span class="muted" v-if="item.description">{{ item.description }}</span>
                            </td>
                            <td>{{ item.category?.name ?? '-' }}</td>
                            <td class="price">{{ money(item.price) }}</td>
                            <td>
                                <button type="button" class="btn" @click.stop="addToReceipt(item)">Toevoegen</button>
                            </td>
                        </tr>
                        <tr v-if="!loading && results.length === 0">
                            <td colspan="5">Geen gerechten gevonden voor deze combinatie van zoekterm en categorie.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="actions" style="justify-content:space-between">
                    <h2>Kassabon</h2>
                    <span class="muted">Iedere toevoeging maakt een nieuwe orderregel aan.</span>
                </div>

                <div class="summary" v-if="receipt.length === 0">
                    Nog geen gerechten geselecteerd. Kies links een gerecht om de kassabon op te bouwen.
                </div>

                <div v-for="(line, index) in receipt" :key="line.uid" class="order-row pos-line-card">
                    <div class="actions" style="justify-content:space-between; align-items:flex-start">
                        <div>
                            <strong>{{ formatMenuNumber(line.item) }} - {{ line.item.name }}</strong><br>
                            <span class="muted">{{ line.item.category?.name ?? 'Onbekende categorie' }}</span>
                        </div>
                        <button type="button" class="btn secondary" @click="removeLine(line.uid)">Verwijderen</button>
                    </div>

                    <div class="grid pos-line-grid">
                        <label>
                            Aantal
                            <input v-model.number="line.quantity" type="number" min="1">
                        </label>

                        <label>
                            Rijstoptie
                            <select v-model="line.riceOptionId">
                                <option value="">Geen keuze</option>
                                <option v-for="rice in riceOptions" :key="rice.id" :value="String(rice.id)">
                                    {{ rice.name }} <template v-if="Number(rice.extra_price) > 0">(+ {{ money(rice.extra_price) }})</template>
                                </option>
                            </select>
                        </label>
                    </div>

                    <label>
                        Opmerking voor deze regel
                        <input
                            v-model="line.note"
                            list="pos-note-suggestions"
                            placeholder="Bijv. geen ui toevoegen"
                        >
                    </label>

                    <div v-if="noteSuggestions.length > 0" class="pos-note-suggestions">
                        <button
                            v-for="suggestion in noteSuggestions"
                            :key="suggestion.note"
                            type="button"
                            class="pill pos-note-pill"
                            @click="applySuggestion(line, suggestion.note)"
                        >
                            {{ suggestion.note }}
                            <span class="muted" v-if="suggestion.usage_count">({{ suggestion.usage_count }}x)</span>
                        </button>
                    </div>

                    <div class="summary pos-line-summary">
                        <span>
                            Rijstkeuze:
                            <strong>{{ selectedRiceName(line) }}</strong>
                        </span>
                        <span class="price">Regeltotaal: {{ money(lineTotal(line)) }}</span>
                    </div>
                </div>

                <div class="summary pos-total-box" v-if="receipt.length > 0">
                    <strong>Totaal kassabon: {{ money(total) }}</strong><br>
                    <span class="muted">{{ totalQuantity }} gerecht(en) verdeeld over {{ receipt.length }} regel(s)</span>
                </div>
            </div>
        </div>

        <datalist id="pos-note-suggestions">
            <option v-for="suggestion in noteSuggestions" :key="suggestion.note" :value="suggestion.note" />
        </datalist>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from 'vue';

const props = defineProps({
    searchUrl: { type: String, required: true },
    categories: { type: Array, default: () => [] },
    riceOptions: { type: Array, default: () => [] },
    noteSuggestions: { type: Array, default: () => [] },
});

const query = ref('');
const selectedCategoryId = ref('');
const selectedRiceId = ref('');
const results = ref([]);
const receipt = ref([]);
const loading = ref(false);
const errorMessage = ref('');
let timeout = null;
let uid = 1;

const total = computed(() => receipt.value.reduce((sum, line) => sum + lineTotal(line), 0));
const totalQuantity = computed(() => receipt.value.reduce((sum, line) => sum + validQuantity(line.quantity), 0));
const selectedCategoryName = computed(() => props.categories.find((category) => String(category.id) === selectedCategoryId.value)?.name ?? '');

watch([query, selectedCategoryId], () => {
    clearTimeout(timeout);
    timeout = setTimeout(search, 180);
});

onMounted(search);

async function search() {
    loading.value = true;
    errorMessage.value = '';

    const params = new URLSearchParams();
    if (query.value.trim()) {
        params.set('q', query.value.trim());
    }
    if (selectedCategoryId.value) {
        params.set('category_id', selectedCategoryId.value);
    }

    try {
        const response = await fetch(`${props.searchUrl}?${params.toString()}`, {
            headers: { Accept: 'application/json' },
        });

        if (!response.ok) {
            throw new Error('De zoekresultaten konden niet worden geladen.');
        }

        results.value = await response.json();
    } catch (error) {
        results.value = [];
        errorMessage.value = error instanceof Error ? error.message : 'Er ging iets mis tijdens het zoeken.';
    } finally {
        loading.value = false;
    }
}

function resetFilters() {
    query.value = '';
    selectedCategoryId.value = '';
    selectedRiceId.value = '';
}

function addToReceipt(item) {
    receipt.value.push({
        uid: uid++,
        item,
        quantity: 1,
        riceOptionId: selectedRiceId.value,
        note: '',
    });
}

function removeLine(lineUid) {
    receipt.value = receipt.value.filter((line) => line.uid !== lineUid);
}

function clearReceipt() {
    receipt.value = [];
}

function applySuggestion(line, note) {
    line.note = note;
}

function selectedRice(line) {
    return props.riceOptions.find((rice) => String(rice.id) === String(line.riceOptionId)) ?? null;
}

function selectedRiceName(line) {
    return selectedRice(line)?.name ?? 'Nog niet gekozen';
}

function lineTotal(line) {
    const base = Number.parseFloat(line.item.price ?? 0);
    const extra = Number.parseFloat(selectedRice(line)?.extra_price ?? 0);
    return (base + extra) * validQuantity(line.quantity);
}

function validQuantity(value) {
    const quantity = Number.parseInt(value, 10);
    return Number.isFinite(quantity) && quantity > 0 ? quantity : 1;
}

function formatMenuNumber(item) {
    return `${item.number ?? ''}${item.suffix ?? ''}` || '-';
}

function money(value) {
    return new Intl.NumberFormat('nl-NL', { style: 'currency', currency: 'EUR' }).format(Number(value) || 0);
}
</script>
