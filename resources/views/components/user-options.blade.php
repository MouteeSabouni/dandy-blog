<div class="relative inline-block text-left">
    <div>
        <button type="button" id="menu-button" class="inline-flex w-full justify-center gap-x-1.5 text-white px-3 py-2 text-sm font-semibold" aria-expanded="false" aria-haspopup="true" onclick="toggleDropdown()">
            {{ auth()->user()->name }}
        <svg class="-mr-1 h-5 w-5 text-gray-400" id="arrow-down" class="h-5 w-5" viewBox="0 0 20 20" fill="white">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" id="arrow-up" class="hidden -mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
        </svg>
        </button>
    </div>

    <div id="dropdown-menu" class="absolute bg-zinc-700 text-white w-44 right-0 z-10 mt-2 origin-top-right rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical">
        <a href="/users/{{ auth()->id() }}" class="block hover:bg-zinc-500 hover:rounded px-4 py-2 text-sm">My profile</a>
        <a href="/posts-by-user/{{ auth()->id() }}" class="block hover:bg-zinc-500 hover:rounded px-4 py-2 text-sm">My posts</a>

        <form method="POST" action="/logout">
            @csrf
            <button class="w-full text-left px-4 py-2 text-sm hover:bg-zinc-500 hover:rounded" type='submit'>Log out</button>
        </form>
    </div>
</div>
