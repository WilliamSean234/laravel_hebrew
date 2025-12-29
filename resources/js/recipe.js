// Isi dari file: recipe.js
window.categoryDropdownTemplate = `
        <select id="category" name="category_id[]"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5">
            <option value="" disabled selected> Pilih Kategori</option>
            {{-- Loop data PHP ke dalam string JS --}}
            @foreach ($product_category as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    `;

const newRowTemplate = `
        <tr class="bg-gray-800 border-b border-gray-700 ingredient-row">
            <td class="p-2"><input type="text" name="ingredient_category[]" 
                class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5" placeholder="Nama"></td>
            
            <td class="p-2">${window.categoryDropdownTemplate}</td> <td class="p-2"><input type="number" name="ingredient_recipe[]" min="0"
                class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 recipe-qty" 
                placeholder="0" oninput="calculateRowTotal(this)"></td>

            <td class="p-2"><input type="text" name="unit_of_measure[]"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 recipe-uom"
            placeholder=""></td>
            
            <td class="p-2"><input type="number" name="ingredient_cost[]" min="0"
                class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 unit-cost" 
                placeholder="Rp 0" oninput="calculateRowTotal(this)"></td>
            
            <td class="p-2">
                <span class="total-cost-display block w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 text-right font-medium">Rp 0</span>
                <input type="hidden" name="ingredient_total_cost[]" class="total-cost-value" value="0">
            </td>
            
            <td class="p-2 text-center">
                <button type="button" onclick="deleteRow(this)"
                    class="font-medium text-red-600 hover:underline text-xs">Hapus</button>
            </td>
        </tr>
    `;

// Pastikan kode ini dieksekusi setelah DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.getElementById('add-ingredient-btn');
    const tableBody = document.getElementById('recipe-body');

    const initialRow = tableBody ? tableBody.querySelector('.ingredient-row') : null;

    if (addButton && tableBody) {
        addButton.addEventListener('click', function () {
            // PERBAIKAN: Gunakan insertAdjacentHTML untuk string
            tableBody.insertAdjacentHTML('beforeend', newRowTemplate);

            // Panggil update COGS setelah baris dimasukkan
            window.updateOverallCOGS();
        });
    }

    const inputs = ['target_profit_percent', 'tax', 'tax_percent'];
    inputs.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', window.calculateSellingPrice);

        }
    });

    // Panggil perhitungan untuk baris yang sudah ada saat halaman dimuat
    window.updateOverallCOGS();
    window.calculateSellingPrice();
});


// FUNGSI PENTING: Mendefinisikan deleteRow secara GLOBAL (di window) 
// agar dapat diakses oleh 'onclick' di HTML, meskipun file JS dimuat sebagai modul oleh Vite.
window.deleteRow = function (buttonElement) {
    const tableBody = document.getElementById('recipe-body');
    // Mencari semua baris bahan baku
    const allRows = tableBody.querySelectorAll('.ingredient-row');

    // Hanya hapus jika ada lebih dari 1 baris
    if (allRows.length > 1) {
        // Mencari elemen <tr> terdekat yang punya class 'ingredient-row' dari tombol yang diklik
        const row = buttonElement.closest('.ingredient-row');
        if (row) {
            row.remove();
        }
    } else {
        // Opsional: Beri peringatan jika hanya 1 baris tersisa
        alert("Minimal satu bahan baku harus dipertahankan.");
    }
    updateOverallCOGS()
    calculateSellingPrice()
}

// ==========================================
// FUNGSI BARU: PERHITUNGAN TOTAL HARGA PER BARIS
// ==========================================
window.calculateRowTotal = function (inputElement) {
    const row = inputElement.closest('.ingredient-row');
    if (!row) return;

    const qtyInput = row.querySelector('.recipe-qty');
    const costInput = row.querySelector('.unit-cost');

    // PERBAIKAN: Mengambil elemen display (<span>) dan value (hidden input) yang baru
    const totalDisplay = row.querySelector('.total-cost-display');
    const totalValueInput = row.querySelector('.total-cost-value');

    if (!qtyInput || !costInput || !totalDisplay || !totalValueInput) return;

    // 1. Ambil nilai sebagai angka
    const qty = parseFloat(qtyInput.value) || 0;
    const cost = parseFloat(costInput.value) || 0;

    // 2. Hitung total
    const total = qty * cost;

    // 3. Masukkan hasil angka (number) ke HIDDEN INPUT (untuk backend)
    // Nilai ini akan dikirim ke Laravel
    totalValueInput.value = total.toFixed(2);

    // 4. Format nilai ke Rupiah untuk tampilan
    const formattedTotal = total.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0, // Tampilan tanpa koma
        maximumFractionDigits: 0
    });

    // 5. Update SPAN/DIV (Visual)
    totalDisplay.textContent = formattedTotal;

    // Opsional: Update Total COGS Keseluruhan
    updateOverallCOGS();
    calculateSellingPrice();
};

// Mengambil nilai COGS murni sebagai angka untuk perhitungan internal
window.getRawCOGS = function () {
    const allTotalValueInputs = document.querySelectorAll('.total-cost-value');
    let grandTotal = 0;
    allTotalValueInputs.forEach(input => {
        grandTotal += parseFloat(input.value) || 0;
    });
    return grandTotal;
};


window.updateOverallCOGS = function () {
    const grandTotal = window.getRawCOGS();
    const cogsDisplay = document.getElementById('overall-cogs-display');

    if (cogsDisplay) {
        cogsDisplay.textContent = grandTotal.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }
    // Setiap kali COGS berubah, harga jual harus dihitung ulang
    window.calculateSellingPrice();
};

window.formatOverhead = function (element) {
    // 1. Ambil hanya angka dari input
    let value = element.value.replace(/[^0-9]/g, '');

    // 2. Simpan angka murni ke input hidden untuk perhitungan
    const hiddenInput = document.getElementById('overhead_cost');
    hiddenInput.value = value || 0;

    // 3. Format tampilan menjadi Rupiah
    if (value) {
        element.value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
    } else {
        element.value = '';
    }

    // 4. Trigger perhitungan ulang harga jual
    window.calculateSellingPrice();
};

window.calculateSellingPrice = function () {
    // 1. Ambil Nilai Dasar
    const totalCOGS = window.getRawCOGS();
    // Mengambil dari input hidden (angka murni)
    const overhead = parseFloat(document.getElementById('overhead_cost').value) || 0;
    const profitPercent = parseFloat(document.getElementById('target_profit_percent').value) || 0;
    const taxPercent = parseFloat(document.getElementById('tax_percent').value) || 0;

    // 2. Kalkulasi
    // Langkah A: Total Biaya Dasar (Bahan + Overhead)
    const baseCost = totalCOGS + overhead;

    // Langkah B: Hitung Nominal Profit dari baseCost
    const profitNominal = baseCost * (profitPercent / 100);
    const profitNominalInput = document.getElementById('target_profit_nominal');

    // Menggunakan .value karena elemennya adalah <input>
    // Gunakan .toFixed(0) untuk angka bulat atau .toFixed(2) jika ingin desimal
    // profitNominalInput.value = Math.round(profitNominal); 
    if (profitNominalInput) {
        // Kita gunakan Intl.NumberFormat untuk format Rupiah
        const formattedProfit = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(profitNominal);

        // Jika input type="text", gunakan .value
        profitNominalInput.value = formattedProfit;
    }

    // -------------------------

    // Langkah C: Harga sebelum pajak
    const priceBeforeTax = baseCost + profitNominal;
    // Langkah D: Hitung Nominal Pajak dari priceBeforeTax
    const taxNominal = priceBeforeTax * (taxPercent / 100);
    const taxNominalInput = document.getElementById('tax_nominal');
    if (taxNominalInput) {
        const formattedTax = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(taxNominal);

        // Jika input type="text", gunakan .value
        taxNominalInput.value = formattedTax;

    }

    // Langkah E: Total Akhir
    const finalSellingPrice = priceBeforeTax + taxNominal;

    // 3. Tampilkan Hasil
    const sellingPriceDisplay = document.getElementById('selling-price-display');
    if (sellingPriceDisplay) {
        sellingPriceDisplay.textContent = finalSellingPrice.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }



    // 4. Update hidden input jika ada (opsional, agar nilai terkirim ke backend)
    let hiddenInput = document.getElementById('selling_price_input');
    if (hiddenInput) {
        hiddenInput.value = finalSellingPrice.toFixed(2);
    }
};
