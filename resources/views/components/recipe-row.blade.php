{{-- NAMA --}}
<tr class="bg-gray-800 border-b border-gray-700 ingredient-row">
    <td class="p-2"><input type="text" name="ingredient_category[]"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5" placeholder="Kategori">
    </td>
    {{-- KATEGORI --}}
    <td class="p-2">
        <select id="category" name="category_id"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5">
            <option value="" disabled selected> Pilih Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name  }}
                </option>

            @endforeach
        </select>
    </td>
    {{-- RESEP (QTY) --}}
    <td class="p-2"><input type="number" name="ingredient_recipe[]" min="0" value="0"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5" placeholder="0"></td>
    {{-- HARGA BELI --}}
    <td class="p-2"><input type="number" name="ingredient_cost[]" min="0" value="0"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5" placeholder="Rp 0"></td>
    {{-- TOTAL HARGA --}}
    <td class="p-2"><input type="number" name="ingredient_cost[]" min="0" value="0"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5" placeholder="Rp 0"></td>
    <td class="p-2 text-center">
        <button type="button" onclick="deleteRow(this)"
            class="font-medium text-red-600 hover:underline text-xs">Hapus</button>
    </td>
</tr>