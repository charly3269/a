<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="/bolt/" class="text-xl font-bold text-gray-800">Sistema de Gestión</a>
            
            <div class="hidden md:flex space-x-6">
                <a href="/bolt/pages/clients/add.php" class="text-gray-600 hover:text-gray-900">Agregar Cliente</a>
                <a href="/bolt/pages/clients/list.php" class="text-gray-600 hover:text-gray-900">Lista de Clientes</a>
                <a href="/bolt/pages/tasks/add.php" class="text-gray-600 hover:text-gray-900">Agregar Tarea</a>
                <a href="/bolt/pages/tasks/list.php" class="text-gray-600 hover:text-gray-900">Mantenimientos</a>
                <a href="/bolt/pages/tasks/archived.php" class="text-gray-600 hover:text-gray-900">Archivados</a>
            </div>

            <button class="md:hidden" id="mobile-menu-button">
                <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="py-2 space-y-2">
                <a href="/bolt/pages/clients/add.php" class="block text-gray-600 hover:text-gray-900 py-2">Agregar Cliente</a>
                <a href="/bolt/pages/clients/list.php" class="block text-gray-600 hover:text-gray-900 py-2">Lista de Clientes</a>
                <a href="/bolt/pages/tasks/add.php" class="block text-gray-600 hover:text-gray-900 py-2">Agregar Tarea</a>
                <a href="/bolt/pages/tasks/list.php" class="block text-gray-600 hover:text-gray-900 py-2">Mantenimientos</a>
                <a href="/bolt/pages/tasks/archived.php" class="block text-gray-600 hover:text-gray-900 py-2">Archivados</a>
            </div>
        </div>
    </div>
</nav>