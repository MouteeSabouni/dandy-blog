<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env('owner') }} — {{ $title ?? '' }}</title>
        @vite('resources/css/app.css')
        {{-- <title>Home Page</title> --}}
        <link rel="icon" type="image/jpeg" href="/images/dandy-logo.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet"></head>

<body class="h-auto bg-dandy-tail">
    <div class="text-white bg-dandy-tail">
        <div class="mx-8 flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center">
                        <img class="h-12 w-12" src="/images/dandy-logo.png" alt="Your Company">
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-end text-xl space-x-5">
                    <x-nav-link href="#services" :active="request()->is('services')">What We Offer</x-nav-link>
                    <x-nav-link href="#contact-us" :active="request()->is('contact')">Contact Us</x-nav-link>
                    <x-nav-link href="/posts" :active="request()->is('posts')">Our Dandy Blog</x-nav-link>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="mr-4 flex items-center md:ml-6 space-x-4">
                    @guest
                    <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                    <x-nav-link href="/login" :active="request()->is('login')">Log in</x-nav-link>
                    @endguest

                    @auth
                        <x-user-options />
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $slot }}
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
</script>
