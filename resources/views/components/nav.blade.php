<div x-data="{ navbarProfileOpen: false, navbarBellOpen: false }"
    class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">

    <!-- Botón para abrir barra lateral en móviles -->
    <button @click="sidebarOpen = true" type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
    </button>

    <!-- El resto -->
    <div class="flex-1 px-4 flex justify-end">

        <!-- Notificaciones y menú desplegable -->
        <div class="ml-4 flex items-center md:ml-6">

            <!-- Menú campana-->
            <div class="relative">

                <!-- Botón del desplegable e icono -->
                <div class="relative inline-flex">
                    <button type="button" @click="navbarBellOpen = !navbarBellOpen"
                            class=" inline-flex items-center bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                    <!-- Punto notificación -->
                    <x-dot-badge/>
                </div>

                <!-- Dropdown menu y enlaces de navegación -->
                <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                     x-cloak x-show="navbarBellOpen" @click.outside="navbarBellOpen = false"
                     @keydown.escape.window="navbarBellOpen = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <x-nav.separator value="Cursos"/>

                    <x-nav.link href="#">
                        Prueba 1
                    </x-nav.link>
                    <x-nav.link href="#">
                        Prueba 2
                    </x-nav.link>
                </div>
            </div>

            <!-- Menú icono -->
            <div class="ml-3 relative">

                <!-- Botón del desplegable e icono -->
                <div class="flex items-center">
                    <p class="hidden md:block mr-2 tracking-wide text-sm font-medium text-gray-500">{{ Str::words(Auth::user()->name, 1, '') }}</p>
                    <button @click="navbarProfileOpen = !navbarProfileOpen" type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="Profile photo">
                    </button>
                </div>

                <!-- Dropdown menu y enlaces de navegación -->
                <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                     x-cloak x-show="navbarProfileOpen" @click.outside="navbarProfileOpen = false"
                     @keydown.escape.window="navbarProfileOpen = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <x-nav.separator value="{{ __('Manage Account') }}"/>

                    <x-nav.link active href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-nav.link>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-nav.link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-nav.link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
