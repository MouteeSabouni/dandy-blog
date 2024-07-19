<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        {{-- <title>Home Page</title> --}}
        <link rel="icon" type="image/jpeg" href="/images/dandy-logo.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet"></head>
        <style>
            textarea::-webkit-scrollbar {
                width: 0px;
                }
        </style>
</head>

<body class="bg-soft-black text-white h-full">
    <div>
        <nav>
            <div class="mx-5 px-4">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                            <a href="/home">
                                <img class="h-30 w-40" src="/images/logo-madewithlove-white.svg" alt="Your Company">
                            </a>

                        <div class="hidden md:block">
                            <div class="ml-9 flex items-center space-x-4">
                                <x-nav-link href="/posts" :active="request()->is('posts')">Newest Posts</x-nav-link>
                                <x-nav-link href="/oldest-posts" :active="request()->is('oldest-posts')">Oldest Posts</x-nav-link>
                                <x-nav-link href="/featured-posts" :active="request()->is('featured-posts')">Featured Posts</x-nav-link>
                                <x-nav-link href="/short-posts" :active="request()->is('short-posts')">Shorts</x-nav-link>
                                <x-search-bar class="flex items-end"/>
                            </div>
                        </div>
                    </div>

                    <div class="hidden md:block">
                        @auth
                            <x-user-options />
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-soft-black">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-white">
                    {{$heading ?? ''}}
                </h1>

                @auth
                    <x-button class="bg-love-red" href="/posts/create">
                        Create a post
                    </x-button>
                @endauth
            </div>
        </header>

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                {{$slot}}
            </div>
        </main>
    </div>
</body>

<script>
    function toggleDropdown() {
        document.getElementById('dropdown-menu').classList.toggle('hidden');
        document.getElementById('arrow-up').classList.toggle('hidden');
        document.getElementById('arrow-down').classList.toggle('hidden');
    }

    // Close the dropdown when clicking outside of it
    document.addEventListener('click', function(event) {
        const menuButton = document.getElementById('menu-button');
        const dropdownMenu = document.getElementById('dropdown-menu');

        if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
            document.getElementById('arrow-up').classList.add('hidden');
            document.getElementById('arrow-down').classList.remove('hidden');
        }
    });

    // Change the body class according to items shown
    document.addEventListener('DOMContentLoaded', () => {
        const updateBodyClass = () => {
            if (document.documentElement.scrollHeight > window.innerHeight) {
                document.body.classList.remove('h-full');
                document.body.classList.add('h-auto');
            } else {
                document.body.classList.remove('h-auto');
                document.body.classList.add('h-full');
            }
    };

    updateBodyClass();

    window.addEventListener('resize', updateBodyClass);
    window.addEventListener('scroll', updateBodyClass);
});

</script>

