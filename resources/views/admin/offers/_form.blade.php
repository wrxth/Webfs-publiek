@csrf
<label>Titel <input name="title" value="{{ old('title', $offer->title) }}" required></label>
<label>Beschrijving <textarea name="description">{{ old('description', $offer->description) }}</textarea></label>
<div class="grid">
    <label>Kortingstype
        <select name="discount_type" required>
            <option value="fixed_price" @selected(old('discount_type', $offer->discount_type) === 'fixed_price')>Vaste prijs</option>
            <option value="amount_off" @selected(old('discount_type', $offer->discount_type) === 'amount_off')>Bedrag korting</option>
            <option value="percentage" @selected(old('discount_type', $offer->discount_type) === 'percentage')>Percentage</option>
        </select>
    </label>
    <label>Waarde <input type="number" step="0.01" name="discount_value" value="{{ old('discount_value', $offer->discount_value) }}" required></label>
    <label>Start <input type="date" name="starts_at" value="{{ old('starts_at', optional($offer->starts_at)->toDateString() ?? $offer->starts_at) }}" required></label>
    <label>Eind <input type="date" name="ends_at" value="{{ old('ends_at', optional($offer->ends_at)->toDateString() ?? $offer->ends_at) }}" required></label>
</div>
<label style="display:flex;gap:8px;align-items:center">
    <input style="width:auto" type="checkbox" name="is_active" value="1" @checked(old('is_active', $offer->is_active ?? true))>
    Aanbieding is actief
</label>
<label>Gerechten in aanbieding
    <select name="menu_item_ids[]" multiple size="12">
        @php
            $selectedMenuItems = collect(old('menu_item_ids', $offer->menuItems?->pluck('id')->all() ?? []))
                ->map(fn ($id) => (int) $id)
                ->all();
        @endphp
        @foreach($menuItems as $item)
            <option value="{{ $item->id }}" @selected(in_array($item->id, $selectedMenuItems, true))>
                {{ $item->number }}{{ $item->suffix }} - {{ $item->name }}
            </option>
        @endforeach
    </select>
</label>
<button class="btn">{{ $submitLabel }}</button>
