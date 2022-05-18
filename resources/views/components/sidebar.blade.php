
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

                <x-sidebar.link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></x-slot>
                    Inicio
                </x-sidebar.link>

                @can('user_show')
                    <x-sidebar.link :href='route("perfil")' :active='request()->route("perfil")'>
                        <x-slot name="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </x-slot>
                        Perfil
                    </x-sidebar.link>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Usuarios" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.usuarios")' :active='request()->route("admin.usuarios")'>
                            Listar todos
                        </x-sidebar.link>
                        <x-sidebar.link class="pl-11" :href='route("admin.roles")' :active='request()->route("admin.roles")'>
                            Roles
                        </x-sidebar.link>
                        <x-sidebar.link class="pl-11" :href='route("admin.participante")' :active='request()->route("admin.participante")'>
                            Participantes
                        </x-sidebar.link>
                        <x-sidebar.link class="pl-11" :href='route("admin.instructores")' :active='request()->route("admin.instructores")'>
                            Instructores
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Periodos de cursos" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.periods-courses")' :active='request()->route("admin.periods-courses")'>
                            Mostrar
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                <x-sidebar.dropdown title="Grupos" dp-id="1">
                    <x-slot name="icon" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </x-slot>
                    <x-sidebar.link class="pl-11" :href='route("admin.group")' :active='request()->route("admin.group")'>
                        Mostrar
                    </x-sidebar.link>
                </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Cursos" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.cursos")' :active='request()->route("admin.cursos")'>
                            Listar Cursos
                        </x-sidebar.link>
                        <x-sidebar.link class="pl-11" :href='route("admin.coursedetail")' :active='request()->route("admin.coursedetail")'>
                            Detalles de Cursos
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Departamentos" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.area")' :active='request()->route("admin.area")'>
                            Mostrar
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Calificaciones" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.grades")' :active='request()->route("admin.grades")'>
                            Asignar
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Constancias" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.constancias")' :active='request()->route("admin.constancias")'>
                            Generar
                        </x-sidebar.link>
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
        <div class="mt-5 flex-1 h-0 overflow-y-auto">
            <nav class="px-2 space-y-1">

                <x-sidebar.link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></x-slot>
                    Inicio
                </x-sidebar.link>

                @can('user_show')
                    <x-sidebar.link :href='route("perfil")' :active='request()->route("perfil")'>
                        <x-slot name="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </x-slot>
                        Perfil
                    </x-sidebar.link>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Usuarios" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.usuarios")' :active='request()->route("admin.usuarios")'>
                            Listar todos
                        </x-sidebar.link>
                        <x-sidebar.link class="pl-11" :href='route("admin.roles")' :active='request()->route("admin.roles")'>
                            Roles
                        </x-sidebar.link>
                        <x-sidebar.link class="pl-11" :href='route("admin.participante")' :active='request()->route("admin.participante")'>
                            Participantes
                        </x-sidebar.link>
                        <x-sidebar.link class="pl-11" :href='route("admin.instructores")' :active='request()->route("admin.instructores")'>
                            Instructores
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                <x-sidebar.dropdown title="Periodos de cursos" dp-id="1">
                    <x-slot name="icon" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </x-slot>
                    <x-sidebar.link class="pl-11" :href='route("admin.periods-courses")' :active='request()->route("admin.periods-courses")'>
                        Mostrar
                    </x-sidebar.link>
                </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                <x-sidebar.dropdown title="Grupos" dp-id="1">
                    <x-slot name="icon" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </x-slot>
                    <x-sidebar.link class="pl-11" :href='route("admin.group")' :active='request()->route("admin.group")'>
                        Mostrar
                    </x-sidebar.link>
                </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Cursos" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.cursos")' :active='request()->route("admin.cursos")'>
                            Listar Cursos
                        </x-sidebar.link>
                        <x-sidebar.link class="pl-11" :href='route("admin.coursedetail")' :active='request()->route("admin.coursedetail")'>
                            Detalles de Cursos
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Departamentos" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.area")' :active='request()->route("admin.area")'>
                            Mostrar
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Calificaciones" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.grades")' :active='request()->route("admin.grades")'>
                            Asignar
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

                @can('user_show')
                    <x-sidebar.dropdown title="Constancias" dp-id="1">
                        <x-slot name="icon" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></x-slot>
                        <x-sidebar.link class="pl-11" :href='route("admin.constancias")' :active='request()->route("admin.constancias")'>
                            Generar
                        </x-sidebar.link>
                    </x-sidebar.dropdown>
                @endcan

            </nav>
        </div>
    </div>
</div>
