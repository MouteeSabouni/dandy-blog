<button {{$attributes->merge([
    'class' => 'relative inline-flex items-center px-4 py-2 text-sm font-medium text-white
    bg-love-red leading-5 rounded-full hover:scale-105 hover:text-bold'])}}
    > {{ $slot }}
</button>

