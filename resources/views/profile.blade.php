<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        {{-- <title>Home Page</title> --}}
        <link rel="icon" type="image/jpeg" href="https://madewithlove.com/blog/content/images/size/w256h256/2023/02/mwl-logo-square.png">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>

<body class="bg-soft-black text-white">
    <div>
        <nav>
            <div class="mx-1 px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="/">
                                <img class="h-12 w-12" src="/images/dandy-logo.png">
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-9 flex items-center space-x-4">
                                <x-nav-link href="/posts" :active="request()->is('posts')">Newest Posts</x-nav-link>
                                <x-nav-link href="/oldest-posts" :active="request()->is('oldest-posts')">Oldest Posts</x-nav-link>
                                <x-nav-link href="/featured-posts" :active="request()->is('featured-posts')">Featured Posts</x-nav-link>
                                <x-nav-link href="/short-posts" :active="request()->is('shorts')">Shorts</x-nav-link>
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
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="/" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
                                <a href="/about" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">About</a>
                                <a href="/contact" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Contact</a>
                </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        <div class="ml-3">
                            <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}</div>
                            <div class="text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}</div>
                        </div>
                        <button type="button" class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>


        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="bg-green-600 text-white px-5 py-3 mb-6 w-fit rounded-full">
                    {{ session('status') }}
                </div>
            @endif
                <p class="font-extrabold text-3xl pb-6">Update your personal details</p>
                <div class="rounded-3xl flex flex-col items-left mb-8 px-8 space-y-4 py-6 h-fit w-full bg-white/5">
                    <form action="/users/{{$user->id}}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="flex flex-col mt-1">
                            <x-forms.input type="text" class="bg-white/10" name="name" value="{{ old('name') ?? $user->name }}" />

                            @error('name')
                                <span class="ml-2 mt-2 text-sm text-red-500">
                                    {{ $message}}
                                </span>
                            @enderror

                            <x-forms.button class="w-fit bg-cyan-700 mt-4" type="submit">
                                Save
                            </x-forms.button>
                        </div>
                    </form>
                </div>

                <p class="font-extrabold text-3xl pb-6">Update your email</p>
                <div class="rounded-3xl flex flex-col items-left mb-8 px-8 space-y-4 py-6 h-fit w-full bg-white/5">
                    <form action="/users/{{$user->id}}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="flex flex-col mt-1">
                            <x-forms.input type="email" class="bg-white/10" name="email" value="{{ old('email') ?? $user->email }}" />

                            @error('email')
                                <span class="ml-2 mt-2 text-sm text-red-500">
                                    {{ $message}}
                                </span>
                            @enderror

                            <x-forms.button class="w-fit bg-cyan-700 mt-4" type="submit">
                                Save
                            </x-forms.button>
                        </div>
                    </form>
                </div>

                <p class="font-extrabold text-3xl pb-6">Change your password</p>
                <div class="rounded-3xl flex flex-col items-left mb-8 px-8 space-y-4 py-6 h-fit w-full bg-white/5">
                    <form action="/users/{{$user->id}}/password" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="flex flex-col mt-1 space-y-4">
                            <div class="flex flex-col">
                                <label class="pb-1">Current password</label>
                                <input name="password_current" type="password" class="tracking-widest rounded-full w-1/2 text-xl bg-white/10 py-2 px-5 text-white" />
                                @error('password_current')
                                <span class="ml-2 mt-2 text-sm text-red-500">
                                    {{ $message}}
                                </span>
                            @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="pb-1">New password</label>
                                <input name="password" type="password" class="tracking-widest rounded-full w-1/2 text-xl bg-white/10 py-2 px-5 text-white" />
                            </div>
                            <div class="flex flex-col">
                                <label class="pb-1">Confirm new password</label>
                                <input name="password_confirmation" type="password" class="tracking-widest rounded-full w-1/2 text-xl bg-white/10 py-2 px-5 text-white" />
                                @error('password')
                                    <span class="ml-2 mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <x-forms.button class="w-fit bg-cyan-700 mt-4" type="submit">
                                    Change
                                </x-forms.button>
                            </div>
                        </div>
                    </form>
                </div>

                <p class="font-extrabold text-3xl pb-6">Delete your account</p>
                <div class="rounded-3xl flex flex-col items-left mb-8 px-8 space-y-4 py-6 h-fit w-full bg-white/5">
                    <p class="w-1/2">Please note the deleting your account will wipe out any records and you won't be able to restore them. However, your account will go into deactivation mode for 15 days during which you can simply log back in with your email and password to cancel deletion.</p>
                    <form action="/users/{{$user->id}}" method="POST">
                        @method('DELETE')
                        @csrf

                        <x-forms.button class="w-fit bg-love-red" type="submit">
                            Delete Account
                        </x-forms.button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

<script>
    // Function to toggle the visibility of the dropdown menu
    function toggleDropdown() {
        const menuButton = document.getElementById('menu-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
        const arrowUp = document.getElementById('arrow-up');
        const arrowDown = document.getElementById('arrow-down');

        // Toggle the 'hidden' class on the dropdown menu
        dropdownMenu.classList.toggle('hidden');
        arrowUp.classList.toggle('hidden');
        arrowDown.classList.toggle('hidden');

        // Update the aria-expanded attribute
        menuButton.setAttribute('aria-expanded', !isExpanded);
    }

    // Optional: Close the dropdown if clicking outside of it
    document.addEventListener('click', function(event) {
        const menuButton = document.getElementById('menu-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const arrowUp = document.getElementById('arrow-up');
        const arrowDown = document.getElementById('arrow-down');

        if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
            arrowUp.classList.toggle('hidden');
            arrowDown.classList.toggle('hidden');
        }
    });
</script>

