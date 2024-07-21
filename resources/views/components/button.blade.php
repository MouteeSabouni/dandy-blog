<a {{$attributes->merge([
    'class' => 'relative inline-flex items-center px-4 py-2 text-sm font-medium text-black
    bg-dandy-orange leading-5 rounded-full hover:scale-110 hover:border-gray-300'])}}>
    {{ $slot }}
</a>
