// Isi dari file: recipe.js

const newRowTemplate = `
        <tr class="bg-gray-800 border-b border-gray-700 ingredient-row">
            <td class="p-2"><input type="text" name="ingredient_category[]" 
                class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5" placeholder="Nama"></td>
            
            <td class="p-2">${window.categoryDropdownTemplate}</td> <td class="p-2"><input type="number" name="ingredient_recipe[]" min="0" value="0"
                class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5 recipe-qty" 
                placeholder="0" oninput="calculateRowTotal(this)"></td>
            
            <td class="p-2"><input type="number" name="ingredient_cost[]" min="0" value="0"
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

    // Panggil perhitungan untuk baris yang sudah ada saat halaman dimuat
    window.updateOverallCOGS();
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
};


// FUNGSI PENTING: Mendefinisikan deleteRow secara GLOBAL (di window) 
// ... (Kode deleteRow tidak berubah) ...


// ==========================================
// FUNGSI OPTIONAL: Menghitung total keseluruhan COGS (Jika digunakan)
// ==========================================
window.updateOverallCOGS = function () {
    // PERBAIKAN: Cari semua input TERSEMBUNYI yang menyimpan nilai angka (total-cost-value)
    const allTotalValueInputs = document.querySelectorAll('.total-cost-value');
    let grandTotal = 0;

    allTotalValueInputs.forEach(input => {
        // Ambil nilai angka langsung dari attribute value
        grandTotal += parseFloat(input.value) || 0;
    });

    const cogsDisplay = document.getElementById('overall-cogs-display');
    if (cogsDisplay) {
        // Format Total Keseluruhan ke Rupiah untuk ditampilkan
        cogsDisplay.textContent = grandTotal.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }
};

