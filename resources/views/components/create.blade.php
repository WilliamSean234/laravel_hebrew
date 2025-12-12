<div class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="max-w-4xl mx-auto bg-gray-800 p-6 sm:p-8 rounded-lg shadow-xl border border-gray-700">

        <h1 class="text-3xl font-bold text-blue-400 border-b-2 border-gray-700 pb-3 mb-6">
            Tambah Produk Minuman Baru
        </h1>

        <form action="#" method="POST" enctype="multipart/form-data">

            <h2 class="text-xl font-semibold text-gray-200 border-b border-gray-600 mt-6 pb-2 mb-4">
                Detail Produk
            </h2>

            <div class="grid md:grid-cols-3 gap-6">
                {{-- Nama Produk (name) --}}
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Nama Produk</label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Contoh: Lemon Tea Dingin" required>
                </div>

                {{-- Kategori/Type (type) --}}
                <div class="mb-4">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-300">Kategori/Tipe Produk</label>
                    <select id="type" name="type"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="americano">Americano</option>
                        <option value="latte">Latte</option>
                        <option value="mancha">Mancha</option>
                    </select>
                </div>

                {{-- Volume/Size (size) --}}
                <div class="mb-4">
                    <label for="size" class="block mb-2 text-sm font-medium text-gray-300">Volume / Ukuran
                        (Size)</label>
                    <input type="text" id="size" name="size"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Contoh: 500ML" required>
                </div>
            </div>

            {{-- Description (description) --}}
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Deskripsi Produk</label>
                <textarea id="description" name="description" rows="4"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Deskripsi singkat tentang rasa atau komposisi utama." required></textarea>
            </div>

            {{-- Image Path (image_path) --}}
            <div class="mb-6">
                <label for="image_path" class="block mb-2 text-sm font-medium text-gray-300">Gambar Produk (Image
                    Path)</label>
                <input type="file" id="image_path" name="image_path"
                    class="block w-full text-sm text-gray-300 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none"
                    accept="image/*">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG (MAX. 800x400px).</p>
            </div>

            <h2 class="text-xl font-semibold text-gray-200 border-b border-gray-600 mt-6 pb-2 mb-4">
                Resep & Bahan Baku
            </h2>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs text-gray-200 uppercase bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/5">NAMA</th>
                            <th scope="col" class="px-6 py-3 w-1/4">KATEGORI</th>
                            <th scope="col" class="px-6 py-3 w-1/6">RESEP (Qty)</th>
                            <th scope="col" class="px-6 py-3 w-1/4">HARGA BELI</th>
                            <th scope="col" class="px-6 py-3 w-1/4">TOTAL HARGA</th>
                            <th scope="col" class="px-6 py-3 w-1/12 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="recipe-body">
                        <x-recipe-row :categories="$categories"></x-recipe-row>
                    </tbody>
                </table>
            </div>

            <button type="button" id="add-ingredient-btn"
                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
                + Tambah Bahan Lain
            </button>


            <h2 class="text-xl font-semibold text-gray-200 border-b border-gray-600 mt-6 pb-2 mb-4">
                Perhitungan Harga
            </h2>

            <div class="grid grid-cols-2 gap-4 p-4 bg-gray-900 rounded-lg border border-gray-700">

                {{-- TOTAL BIAYA BAHAN BAKU --}}
                <div class="text-lg font-bold text-gray-300 py-2">TOTAL BIAYA BAHAN BAKU (COGS)</div>
                <div class="text-lg font-extrabold text-green-500 bg-gray-700 rounded p-2 text-right">Rp 12,350</div>

                {{-- Biaya Overhead (overhead_cost) --}}
                <label for="overhead_cost" class="text-md text-gray-300 py-2">Biaya Overhead (opsional)</label>
                <input type="number" id="overhead_cost" name="overhead_cost" min="0" value="500"
                    class="bg-gray-700 border border-gray-600 text-white text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 text-right">

                {{-- Target Profit --}}
                <label for="target_profit" class="text-md text-gray-300 py-2">Target Profit (%)</label>
                <input type="number" id="target_profit" name="target_profit" min="0" value="30"
                    class="bg-gray-700 border border-gray-600 text-white text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 text-right">

                {{-- Pajak Penjualan --}}
                <label for="tax" class="text-md text-gray-300 py-2">Pajak Penjualan (%)</label>
                <input type="number" id="tax" name="tax" min="0" value="10"
                    class="bg-gray-700 border border-gray-600 text-white text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 text-right">

                {{-- HARGA JUAL (selling_price) --}}
                <div class="text-xl font-bold text-blue-400 py-2">HARGA JUAL AKHIR</div>
                <div class="text-xl font-extrabold text-white bg-blue-600 rounded p-2 text-right">Rp 19,500</div>
                <input type="hidden" name="selling_price" value="19500">

            </div>

            <div class="flex justify-end space-x-4 pt-8">
                <button type="button"
                    class="text-gray-900 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
                    Batal
                </button>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
                    Simpan Produk & Harga
                </button>
            </div>
        </form>
    </div>
</div>