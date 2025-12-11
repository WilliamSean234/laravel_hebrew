@props(['active' => false])
{{-- agar tidak muncul di html --}}

<a {{ $attributes }} class=" {{ 
    $active ?
    'bg-blue-600 text-white'
    :
    'text-gray-300 hover:bg-gray-700 hover:text-white'
    }}
    px-3 py-1.5 rounded-md text-sm font-medium
    " aria-current="{{ $active ? 'page' : false }}">
    {{ $slot }}
</a>