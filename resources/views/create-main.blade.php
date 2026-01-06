{{-- dd({{$product_category}}) --}}
<x-layout>
    @if(session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
        {{ session('error') }}
    </div>
@endif

{{-- Menampilkan error validasi jika ada --}}
@if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <x-create :categories="$material_categories" :materials="$materials"></x-create>
</x-layout>