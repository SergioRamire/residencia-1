@php
    /* Devuelve el primer (y único) rol del usuario autenticado */
    $role = auth()->user()->getRoleNames()->first();
    $route = $role === 'super-admin' ? '' : "{$role}." ;
@endphp

<!-- Barra lateral para móviles -->
<div x-cloak x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">

    <!-- Superposición con opacidad -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"
         x-cloak x-show="sidebarOpen" @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Menú -->
    <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white"
         x-cloak x-show="sidebarOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full">

        <!-- Botón de cierre -->
        <div class="absolute top-0 right-0 -mr-12 pt-2"
             x-cloak x-show="sidebarOpen"
             x-transition:enter="ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            <button @click="sidebarOpen = false" type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <span class="sr-only">Close sidebar</span>
                <x-icon.close class="h-6 w-6 text-white"/>
            </button>
        </div>

        <!-- Logotipo -->
        <div class="flex-shrink-0 flex items-center px-4">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
        </div>

        <!-- Enlaces de navegación -->
        <div class="mt-5 flex-1 h-0 overflow-y-auto">
            <nav class="px-2 space-y-1">
                <x-sidebar.link :href='route("{$route}dashboard")' :active='request()->routeIs("{$route}dashboard")'>
                    <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></x-slot>
                    Dashboard
                </x-sidebar.link>

                @can('user_show')
                    <x-sidebar.dropdown title="Usuarios">
                        <x-slot name="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </x-slot>

                        <x-sidebar.link :href='route("{$route}users")' :active='request()->routeIs("{$route}users")' class="pl-11">Listar</x-sidebar.link>
                        <x-sidebar.link :href='route("{$route}users.roles")' class="pl-11">Configurar roles</x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('course_show')
                    <x-sidebar.link :href='route("{$route}courses")' :active='request()->routeIs("{$route}courses")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></x-slot>
                        Cursos
                    </x-sidebar.link>

                @endcan

                @can('grades_show')
                    <x-sidebar.link :href='route("{$route}grades")' :active='request()->routeIs("{$route}grades")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></x-slot>
                        Calificaciones
                    </x-sidebar.link>
                @endcan

                @can('inscriptions_show')
                    <x-sidebar.link :href='route("{$route}inscriptions")' :active='request()->routeIs("{$route}inscriptions")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></x-slot>
                        Inscripciones
                    </x-sidebar.link>
                @endcan

                @can('areas_show')
                    <x-sidebar.link :href='route("{$route}area")' :active='request()->routeIs("{$route}area")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></x-slot>
                        Departamentos
                    </x-sidebar.link>
                @endcan

                @can('groups_show')
                    <x-sidebar.link :href='route("{$route}group")' :active='request()->routeIs("{$route}agroup")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></x-slot>
                        Grupos
                    </x-sidebar.link>
                @endcan

                @can('participant_show')
                    <x-sidebar.link :href='route("{$route}participantes")' :active='request()->routeIs("{$route}participantes")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></x-slot>
                        Participantes
                    </x-sidebar.link>
                @endcan

                @can('constancias_show')
                    <x-sidebar.link :href='route("{$route}constancias")' :active='request()->routeIs("{$route}constancias")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></x-slot>
                        Constancias
                    </x-sidebar.link>
                 @endcan
                 
                 @can('instructor_show')
                    <x-sidebar.dropdown title="Instructor">
                        <x-slot name="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </x-slot>
                        
                        <x-sidebar.link :href='route("{$route}instructor")' :active='request()->routeIs("{$route}instructor")' class="pl-11">Listar</x-sidebar.link>
                    </x-sidebar.dropdown>
                   @endcan
            </nav>
        </div>
    </div>

    <!-- Elemento ficticio para obligar a la barra lateral a encogerse para ajustarse al icono de cierre -->
    <div class="flex-shrink-0 w-14" aria-hidden="true">
    </div>
</div>

<!-- Barra lateral para escritorio -->
<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">

    <!-- Menú -->
    <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 bg-white overflow-y-auto">

        <!-- Logotipo -->
        <div class="flex items-center flex-shrink-0 px-4">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
        </div>

        <!-- Enlaces de navegación -->
        <div class="mt-5 flex-grow flex flex-col">
            <nav class="flex-1 px-2 pb-4 space-y-1">
                <x-sidebar.link :href='route("{$route}dashboard")' :active='request()->routeIs("{$route}dashboard")'>
                    <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></x-slot>
                    Dashboard
                </x-sidebar.link>

                @can('user_show')
                    <x-sidebar.dropdown title="Usuarios">
                        <x-slot name="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </x-slot>

                        <x-sidebar.link :href='route("{$route}users")' :active='request()->routeIs("{$route}users")' class="pl-11">Listar</x-sidebar.link>
                        <x-sidebar.link :href='route("{$route}users.roles")' class="pl-11">Configurar roles</x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan
                
                @can('course_show')
                    <x-sidebar.link :href='route("{$route}courses")' :active='request()->routeIs("{$route}courses")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></x-slot>
                        Cursos
                    </x-sidebar.link>
                @endcan

                @can('grades_show')
                    <x-sidebar.link :href='route("{$route}grades")' :active='request()->routeIs("{$route}grades")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></x-slot>
                        Calificaciones
                    </x-sidebar.link>
                @endcan

                @can('inscription_show')
                    <x-sidebar.link :href='route("{$route}inscriptions")' :active='request()->routeIs("{$route}inscriptions")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></x-slot>
                        Inscripciones
                    </x-sidebar.link>
                @endcan

                @can('areas_show')
                    <x-sidebar.link :href='route("{$route}area")' :active='request()->routeIs("{$route}area")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" /></x-slot>
                        Departamentos
                    </x-sidebar.link>
                @endcan

                @can('groups_show')
                    <x-sidebar.link :href='route("{$route}group")' :active='request()->routeIs("{$route}agroup")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></x-slot>
                        Grupos
                    </x-sidebar.link>
                @endcan

                @can('participant_show')
                    <x-sidebar.link :href='route("{$route}participantes")' :active='request()->routeIs("{$route}participantes")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></x-slot>
                        Participantes
                    </x-sidebar.link>
                @endcan

                @can('constancias_show')
                    <x-sidebar.link :href='route("{$route}constancias")' :active='request()->routeIs("{$route}constancias")'>
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></x-slot>
                        Constancias
                    </x-sidebar.link>
                 @endcan
                 
                 @can('instructor_show')
                    <x-sidebar.dropdown title="instructor">
                        <x-slot name="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </x-slot>

                        <x-sidebar.link :href='route("{$route}instructor")' :active='request()->routeIs("{$route}instructor")' class="pl-11">Listar</x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

            </nav>
        </div>
    </div>
</div>
