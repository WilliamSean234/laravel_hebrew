<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/recipe.js'])

    <title>Product Dashboard - Flowbite Example</title>

</head>

<body class="bg-gray-800 dark:bg-gray-900 font-sans">
    <div class="min-h-full">
        <x-top-nav></x-top-nav>
        {{-- <x-product-dashboard :products="$products" :products_count="$products->count()"></x-product-dashboard> --}}

        {{-- <x-create></x-create> --}}
        <main>
            {{ $slot }}
        </main>




    </div>
    <x-sweet-alert></x-sweet-alert>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{--
    <script src='resources/js/recipe.js'></script> --}}
</body>

</html>