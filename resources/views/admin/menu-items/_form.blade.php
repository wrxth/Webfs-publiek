@csrf
<div class="grid">
    <label>Categorie
        <select name="menu_category_id" required>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('menu_category_id', $menuItem->menu_category_id ?? '') == $category->id)>{{ $category->name }}</option>@endforeach</select>
    </label>
    <label>Nummer <input type="number" name="number" value="{{ old('number', $menuItem->number ?? '') }}"></label>
    <label>Toevoeging <input name="suffix" value="{{ old('suffix', $menuItem->suffix ?? '') }}" placeholder="A/B/C"></label>
    <label>Prijs <input type="number" step="0.01" name="price" value="{{ old('price', $menuItem->price ?? '') }}" required></label>
</div>
<label>Naam <input name="name" value="{{ old('name', $menuItem->name ?? '') }}" required></label>
<label>Beschrijving <textarea name="description">{{ old('description', $menuItem->description ?? '') }}</textarea></label>
<label>Afbeelding pad <input name="image_path" value="{{ old('image_path', $menuItem->image_path ?? '') }}"></label>
<label><input style="width:auto" type="checkbox" name="is_active" value="1" @checked(old('is_active', $menuItem->is_active ?? true))> Actief</label>
<button class="btn">Opslaan</button>
