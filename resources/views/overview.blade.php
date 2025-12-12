<x-layout>

    <x-product-dashboard :products="$products" :products_count="$products->count()">
        <x-slot:products_count>{{ $products_count }}</x-slot:products_count>
    </x-product-dashboard>

</x-layout>