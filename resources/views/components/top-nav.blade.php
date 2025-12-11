<nav class="bg-gray-900 border-b border-gray-700">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">

        <a href="#" class="text-xl font-semibold text-white">
            <span class="text-blue-500">flowbite</span>.com
        </a>

        <div class="flex items-center space-x-3">
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                Open app
            </button>
            <button type="button" class="p-1 rounded-full text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 border-t border-gray-700 bg-gray-800/50">
        <div class="flex items-center h-12">
            <div class="flex space-x-1">


                <x-nav-link href="/" :active="request()->is('/')">Overview</x-nav-link>
                <x-nav-link href="/create-main" :active="request()->is('create-main')">COGS</x-nav-link>

            </div>
        </div>
    </div>
</nav>