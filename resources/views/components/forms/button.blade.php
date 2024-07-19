<button {{$attributes->merge([
    'class' => 'relative inline-flex items-center px-4 py-2 text-sm font-medium
    bg-dandy-orange text-black leading-5 rounded-full hover:scale-110 hover:text-bold'])}}
    > {{ $slot }}
</button>

