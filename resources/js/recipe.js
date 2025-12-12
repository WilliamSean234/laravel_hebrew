// Isi dari file: recipe.js

const newRowTemplate = `
    <tr class="bg-gray-800 border-b border-gray-700 ingredient-row">
        <td class="p-2"><input type="text" name="ingredient_category[]" 
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5"
            placeholder="Kategori"></td>
        <td class="p-2"><input type="text" name="ingredient_name[]" 
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5"
            placeholder="Nama Bahan"></td>
        <td class="p-2"><input type="number" name="ingredient_recipe[]" min="0" value="0"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5"
            placeholder="0"></td>
        <td class="p-2"><input type="number" name="ingredient_cost[]" min="0" value="0"
            class="w-full bg-gray-900 border border-gray-700 text-sm text-white rounded p-1.5"
            placeholder="Rp 0"></td>
        <td class="p-2 text-center">
            <button type="button" onclick="deleteRow(this)"
                class="font-medium text-red-600 hover:underline text-xs">Hapus</button>
        </td>
    </tr>
`;

// Pastikan kode ini dieksekusi setelah DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.getElementById('add-ingredient-btn');
    if (addButton) {
        addButton.addEventListener('click', function () {
            const tableBody = document.getElementById('recipe-body');
            tableBody.insertAdjacentHTML('beforeend', newRowTemplate);
        });
    }
});

// FUNGSI PENTING: Mendefinisikan deleteRow secara GLOBAL (di window) 
// agar dapat diakses oleh 'onclick' di HTML, meskipun file JS dimuat sebagai modul oleh Vite.
window.deleteRow = function(buttonElement) {
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