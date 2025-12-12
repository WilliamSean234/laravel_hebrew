{{-- NAMA --}}
<tr class="bg-gray-800 border-b border-gray-700 ingredient-row">
    <td class="p-2"><input type="text" name="ingredient_category[]"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5" placeholder="Nama">
    </td>
    {{-- KATEGORI --}}
    <td class="p-2">
        <select id="category" name="category_id[]"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5">
            <option value="" disabled selected> Pilih Kategori</option>
            {{-- Menggunakan variabel dari controller utama --}}
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </td>

    {{-- RESEP (QTY) --}}
    <td class="p-2"><input type="number" name="ingredient_recipe[]" min="0"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 recipe-qty"
            placeholder="0" oninput="calculateRowTotal(this)"></td>

    {{-- HARGA BELI (UNIT COST) --}}
    <td class="p-2">
        <input type="number" name="ingredient_cost[]" min="0" value="0"
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