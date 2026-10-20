<template>
    <div class="tablet-order-shell">
        <div class="toolbar">
            <label style="min-width:260px">Zoek gerecht
                <input v-model="query" placeholder="Nummer, naam of omschrijving">
            </label>
            <label style="min-width:220px">Rijst / bami optie
                <select v-model="selectedRiceId">
                    <option value="">Geen extra</option>
                    <option v-for="rice in riceOptions" :key="rice.id" :value="String(rice.id)">
                        {{ rice.name }} (+ {{ money(rice.extra_price) }})
                    </option>
                </select>
            </label>
            <button type="button" class="btn secondary" @click="clearCart" :disabled="cart.length === 0">Leeg bestelling</button>
        </div>

        <div v-if="orderHistory.length > 0" class="paper-card tablet-history-panel">
            <div class="actions" style="justify-content:space-between">
                <span class="pill">{{ orderHistory.length }} ronde(s)</span>
            </div>

            <div class="tablet-history-list">
                <section v-for="order in orderHistory" :key="order.id" class="tablet-history-card">
                    <div class="tablet-history-head">
                        <div>
                            <h3>Ronde {{ order.round_number ?? '?' }}</h3>
                            <p class="muted">Bestelling {{ order.order_number }}{{ order.ordered_at ? ` | ${order.ordered_at}` : '' }}</p>
                        </div>
                        <div class="tablet-history-meta">
                            <strong>{{ money(order.total) }}</strong>
                            <button type="button" class="btn" @click="repeatOrder(order)">Bestel hele ronde opnieuw</button>
                        </div>
                    </div>

                    <div class="tablet-history-lines">
                        <div v-for="line in order.items" :key="line.id" class="tablet-history-line">
                            <div>
                                <strong>{{ line.quantity }}x {{ formatMenuNumber(line.menu_item) }} {{ line.menu_item?.name ?? 'Niet beschikbaar' }}</strong>
                                <div class="muted">
                                    <span v-if="line.rice_option">{{ line.rice_option.name }}</span>
                                    <span v-if="line.note">{{ line.rice_option ? ' | ' : '' }}{{ line.note }}</span>
                                </div>
                            </div>
                            <button
                                type="button"
                                class="btn secondary"
                                :disabled="!line.menu_item"
                                @click="repeatLine(line)"
                            >
                                Voeg regel toe
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="grid">
            <div>
                <h2>Menukaart</h2>
                <table>
                    <tr><th>Nr</th><th>Gerecht</th><th>Prijs</th><th></th></tr>
                    <tr v-for="item in filteredItems" :key="item.id">
                        <td>{{ formatMenuNumber(item) }}</td>
                        <td>
                            <strong>{{ item.name }}</strong><br>
                            <span class="muted" v-if="item.description">{{ item.description }}</span>
                        </td>
                        <td class="price">{{ money(item.price) }}</td>
                        <td><button type="button" class="btn" @click="addItem(item)">Toevoegen</button></td>
                    </tr>
                    <tr v-if="filteredItems.length === 0"><td colspan="4">Geen gerechten gevonden.</td></tr>
                </table>
            </div>

            <div>
                <h2>Samengestelde bestelling</h2>
                <div class="summary" v-if="cart.length === 0">Voeg minimaal een gerecht toe.</div>
                <div v-for="(line, index) in cart" :key="line.uid" class="order-row">
                    <strong>{{ formatMenuNumber(line.item) }} - {{ line.item.name }}</strong>
                    <span class="pill" v-if="line.rice">{{ line.rice.name }}</span>
                    <div class="grid">
                        <label>Aantal
                            <input type="number" min="1" v-model.number="line.quantity">
                        </label>
                        <label>Opmerking
                            <input v-model="line.note" placeholder="Bijv. zonder ui">
                        </label>
                    </div>
                    <div class="actions">
                        <span class="price">Regel: {{ money(lineTotal(line)) }}</span>
                        <button type="button" class="btn secondary" @click="removeLine(index)">Verwijderen</button>
                    </div>

                    <input type="hidden" :name="`items[${index}][menu_item_id]`" :value="line.item.id">
                    <input type="hidden" :name="`items[${index}][rice_option_id]`" :value="line.rice?.id ?? ''">
                    <input type="hidden" :name="`items[${index}][quantity]`" :value="validQuantity(line.quantity)">
                    <input type="hidden" :name="`items[${index}][note]`" :value="line.note">
                </div>
                <div class="summary" style="margin-top:12px" v-if="cart.length > 0">
                    <strong>Totaal: {{ money(total) }}</strong><br>
                    <span class="muted">{{ cart.length }} bestelregel(s)</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    items: { type: Array, required: true },
    riceOptions: { type: Array, required: true },
    orderHistory: { type: Array, default: () => [] },
});

const query = ref('');
const selectedRiceId = ref('');
const cart = ref([]);
let uid = 1;

const itemIndex = computed(() => new Map(props.items.map((item) => [item.id, item])));

const filteredItems = computed(() => {
    const q = query.value.trim().toLowerCase();
    if (!q) return props.items;
    return props.items.filter((item) => {
        const number = formatMenuNumber(item).toLowerCase();
        return number.includes(q)
            || String(item.name ?? '').toLowerCase().includes(q)
            || String(item.description ?? '').toLowerCase().includes(q);
    });
});

const selectedRice = computed(() => props.riceOptions.find((rice) => String(rice.id) === String(selectedRiceId.value)) ?? null);

const total = computed(() => cart.value.reduce((sum, line) => sum + lineTotal(line), 0));

function addItem(item) {
    cart.value.push({ uid: uid++, item, rice: selectedRice.value, quantity: 1, note: '' });
}

function addConfiguredLine({ itemId, quantity = 1, riceOptionId = null, note = '' }) {
    const item = itemIndex.value.get(itemId);
    if (!item) {
        return;
    }

    const rice = props.riceOptions.find((option) => String(option.id) === String(riceOptionId ?? '')) ?? null;

    cart.value.push({
        uid: uid++,
        item,
        rice,
        quantity: validQuantity(quantity),
        note,
    });
}

function repeatOrder(order) {
    order.items.forEach((line) => repeatLine(line));
}

function repeatLine(line) {
    if (!line.menu_item?.id) {
        return;
    }

    addConfiguredLine({
        itemId: line.menu_item.id,
        quantity: line.quantity,
        riceOptionId: line.rice_option?.id ?? null,
        note: line.note ?? '',
    });
}

function removeLine(index) {
    cart.value.splice(index, 1);
}

function clearCart() {
    cart.value = [];
}

function validQuantity(value) {
    const quantity = Number.parseInt(value, 10);
    return Number.isFinite(quantity) && quantity > 0 ? quantity : 1;
}

function lineTotal(line) {
    const base = Number.parseFloat(line.item.price ?? 0);
    const extra = Number.parseFloat(line.rice?.extra_price ?? 0);
    return (base + extra) * validQuantity(line.quantity);
}

function formatMenuNumber(item) {
    if (!item) {
        return '-';
    }

    const number = `${item.number ?? ''}${item.suffix ?? ''}`.trim();
    return number || '-';
}

function money(value) {
    return new Intl.NumberFormat('nl-NL', { style: 'currency', currency: 'EUR' }).format(Number(value) || 0);
}
</script>
