{{-- dd({{$product_category}}) --}}
<x-layout>
    <x-create :categories="$product_category"></x-create>
</x-layout>


<script>
    // Menyimpan string HTML dari dropdown kategori ke variabel global (tanpa tag <td>)
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
</script>
<script src="{{ asset('js/recipe.js') }}"></script>