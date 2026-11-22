<nav class="fixed left-0 right-0 top-0 z-50 border-b border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800">
    <div class="flex flex-wrap items-center justify-between">
        <div class="flex items-center justify-start">
            <button id="sidebar-toggle" type="button"
                class="mr-3 inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 md:hidden dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Buka sidebar</span>
                <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            <a href="{{ url('/admin/dashboard') }}" class="mr-4 flex items-center">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600">
                    <svg class="h-5 w-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                </span>
                <span class="ml-3 self-center whitespace-nowrap text-xl font-semibold dark:text-white">Flowbite</span>
            </a>
            <form action="#" method="GET" class="hidden md:block md:pl-2">
                <label for="topbar-search" class="sr-only">Search</label>
                <div class="relative md:w-80 lg:w-96">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="topbar-search"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Search">
                </div>
            </form>
        </div>
        <div class="flex items-center gap-1 lg:order-2">
            <button id="theme-toggle" type="button"
                class="rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                <span class="sr-only">Ganti tema</span>
                <svg class="theme-toggle-dark-icon hidden h-5 w-5" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z"
                        clip-rule="evenodd" />
                </svg>
                <svg class="theme-toggle-light-icon hidden h-5 w-5" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0Zm.75 7.5a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6ZM5.106 17.954a.75.75 0 0 1-.107-1.056l1.591-1.909a.75.75 0 1 1 1.152.96l-1.59 1.909a.75.75 0 0 1-1.056.096Zm-.096-14.85a.75.75 0 0 1 1.056.096l1.591 1.909a.75.75 0 1 1-1.152.96l-1.59-1.909a.75.75 0 0 1 .095-1.056ZM2.25 12a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1-.75-.75Zm19.5 0a.75.75 0 0 1 .75-.75H21.75a.75.75 0 0 1 0 1.5H21.75a.75.75 0 0 1-.75-.75Zm-1.841 6.25a.75.75 0 0 1 1.056-.096l1.591 1.909a.75.75 0 1 1-1.152.96l-1.59-1.909a.75.75 0 0 1 .095-1.056ZM18.75 12a.75.75 0 0 1 .75-.75H21a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75Zm-3.443-5.839a.75.75 0 0 1 .096 1.056l-1.59 1.909a.75.75 0 1 1-1.152-.96l1.591-1.909a.75.75 0 0 1 1.055-.096Z" />
                </svg>
            </button>
            <button type="button" id="user-menu-button" data-dropdown-toggle="user-dropdown"
                class="mx-3 flex rounded-full bg-gray-800 text-sm focus:ring-4 focus:ring-gray-300 md:mr-0 dark:focus:ring-gray-600">
                <span class="sr-only">Buka menu pengguna</span>
                <img class="h-8 w-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt="Foto profil">
            </button>
            <div id="user-dropdown"
                class="z-50 my-4 hidden w-56 list-none divide-y divide-gray-100 rounded-lg bg-white text-base shadow dark:divide-gray-600 dark:bg-gray-700">
                <div class="px-4 py-3">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-white">Admin Sekolah</span>
                    <span class="block truncate text-sm text-gray-500 dark:text-gray-300">admin@sekolah.id</span>
                </div>
                <ul class="py-1 text-gray-700 dark:text-gray-300">
                    <li>
                        <a href="{{ url('/admin/dashboard') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
                            out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
