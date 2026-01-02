<tr class="bg-gray-800 border-b border-gray-700 ingredient-row">
    {{-- NAMA --}}
    {{-- <td class="p-2"><input type="text" name="ingredient_name[]"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5" placeholder="Nama">
    </td> --}}
    <td class="p-2 w-1/3">
        <select name="ingredient_name[]" onchange="updateMaterialCategory(this)"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5">
            <option value="" disabled selected>Pilih Bahan</option>
            {{-- Menggunakan variabel dari controller utama --}}
            @foreach ($materials as $material)
                <option value="{{ $material->id }}" data-category="{{ $material->category->name }}">
                    {{ $material->name }}
                </option>
            @endforeach
        </select>
    </td>

    <td class="p-4"><input type="text" name="category_name[]"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 category-display"
            oninput="" readonly></td>    


    {{-- RESEP (QTY) --}}
    <td class="p-2"><input type="number" name="ingredient_recipe[]" min="0"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 recipe-qty"
            placeholder="0" oninput="calculateRowTotal(this)"></td>

    {{-- UNIT OF MEASURE --}}
    <td class="p-2"><input type="text" name="unit_of_measure[]"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 recipe-uom"
            placeholder=""></td>

    {{-- HARGA BELI (UNIT COST) --}}
    <td class="p-2">
        <input type="number" name="ingredient_cost[]" min="0"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 unit-cost"
            placeholder="Rp 0" oninput="calculateRowTotal(this)">
    </td>

    {{-- TOTAL HARGA (PERUBAHAN UTAMA DI SINI) --}}
    <td class="p-2">

        {{-- 1. Display Element (Menampilkan Rupiah) --}}
        <span
            class="total-cost-display block w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 text-right font-medium">
            Rp 0
        </span>

        {{-- 2. Hidden Input (Mengirim Nilai Angka Murni ke Backend) --}}
        <input type="hidden" name="ingredient_total_cost[]" class="total-cost-value" value="0">

    </td>

    <td class="p-2 text-center">
        <button type="button" onclick="deleteRow(this)"
            class="font-medium text-red-600 hover:underline text-xs">Hapus</button>
    </td>
</tr>