<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <!-- Sidebar untuk Mobile (Overlay) -->
        <div x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" @click="sidebarOpen = false">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div @click.stop class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-800">
                <div class="p-4 text-white text-xl font-bold">Admin Panel</div>
                <nav x-data="{ transOpen: false, masterOpen: false }" class="mt-5 flex-1 px-2 space-y-1">
                    <a href="<?= base_url('admin/dashboard') ?>" class="block py-2.5 px-4 rounded text-white transition duration-200 hover:bg-gray-700">Dashboard</a>
                    <a href="<?= base_url('admin/manage_agents') ?>" class="block py-2.5 px-4 rounded text-white transition duration-200 hover:bg-gray-700">Manajemen Agen</a>
                    <a href="<?= base_url('admin/manage_users') ?>" class="block py-2.5 px-4 rounded text-white transition duration-200 hover:bg-gray-700">Manajemen Nasabah</a>
                    
                    <!-- Menu Dropdown Transaksi -->
                    <div>
                        <button @click="transOpen = !transOpen" class="w-full flex justify-between items-center py-2.5 px-4 rounded text-white transition duration-200 hover:bg-gray-700">
                            <span>Manajemen Transaksi</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': transOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="transOpen" x-transition class="pl-4">
                            <a href="#" class="block py-2 px-4 text-sm rounded text-white transition duration-200 hover:bg-gray-700">Riwayat Setoran</a>
                            <a href="#" class="block py-2 px-4 text-sm rounded text-white transition duration-200 hover:bg-gray-700">Riwayat Penarikan</a>
                        </div>
                    </div>

                    <!-- Menu Dropdown Data Master -->
                     <div>
                        <button @click="masterOpen = !masterOpen" class="w-full flex justify-between items-center py-2.5 px-4 rounded text-white transition duration-200 hover:bg-gray-700">
                            <span>Data Master</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': masterOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="masterOpen" x-transition class="pl-4">
                            <a href="<?= base_url('admin/waste_types') ?>" class="block py-2 px-4 text-sm rounded text-white transition duration-200 hover:bg-gray-700">Jenis Sampah</a>
                        </div>
                    </div>

                    <a href="<?= base_url('home/logout') ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Logout</a>
                </nav>
            </div>
        </div>

        <!-- Sidebar untuk Desktop -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-gray-800 text-white">
                <div class="p-4 text-xl font-bold">Admin Panel</div>
                <nav x-data="{ transOpen: false, masterOpen: false }" class="mt-10 px-2">
                    <a href="<?= base_url('admin/dashboard') ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Dashboard</a>
                    <a href="<?= base_url('admin/manage_agents') ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Manajemen Agen</a>
                    <a href="<?= base_url('admin/manage_users') ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Manajemen Nasabah</a>

                    <!-- Menu Dropdown Transaksi -->
                    <div>
                        <button @click="transOpen = !transOpen" class="w-full flex justify-between items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                            <span>Manajemen Transaksi</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': transOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="transOpen" x-transition class="pl-4 mt-1">
                            <a href="#" class="block py-2 px-4 text-sm rounded transition duration-200 hover:bg-gray-700">Riwayat Setoran</a>
                            <a href="#" class="block py-2 px-4 text-sm rounded transition duration-200 hover:bg-gray-700">Riwayat Penarikan</a>
                        </div>
                    </div>

                     <!-- Menu Dropdown Data Master -->
                     <div>
                        <button @click="masterOpen = !masterOpen" class="w-full flex justify-between items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                            <span>Data Master</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': masterOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="masterOpen" x-transition class="pl-4 mt-1">
                            <a href="<?= base_url('admin/waste_types') ?>" class="block py-2 px-4 text-sm rounded transition duration-200 hover:bg-gray-700">Jenis Sampah</a>
                        </div>
                    </div>

                    <a href="<?= base_url('home/logout') ?>" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Logout</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <!-- Tombol Hamburger untuk Mobile -->
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none focus:text-gray-700 md:hidden">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-xl font-bold ml-4 md:ml-0">Admin Dashboard</h1>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                <?php $this->load->view($view_name); ?>
            </main>
        </div>
    </div>

</body>
</html>
