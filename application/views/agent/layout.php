<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF--8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full">
    <div x-data="{ sidebarOpen: false }">
        <div x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" @click="sidebarOpen = false">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div @click.stop class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-800">
                <div class="flex items-center justify-center h-16 bg-gray-900">
                    <span class="text-white font-bold uppercase">Agent Panel</span>
                </div>
                <nav class="mt-5 flex-1 px-2 space-y-1">
                    <a href="<?= base_url('agent/dashboard') ?>" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a>
                    <a href="<?= base_url('agent/my_user') ?>" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">Nasabah</a>
                    <a href="<?= base_url('agent/transactions') ?>" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">Transaksi</a>
                    <a href="<?= base_url('agent/profile') ?>" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">Profil</a>
                    <a href="<?= base_url('home/logout') ?>" class="flex items-center py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">Logout</a>
                </nav>
            </div>
        </div>

        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <div class="flex flex-col flex-grow bg-gray-800 pt-5 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4">
                    <span class="text-white text-xl font-bold">Agent Panel</span>
                </div>
                <div class="mt-5 flex-1 flex flex-col">
                    <nav class="flex-1 px-2 pb-4 space-y-1">
                        <a href="<?= base_url('agent/dashboard') ?>" class="flex items-center mt-4 py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-gray-100">Dashboard</a>
                        <a href="<?= base_url('agent/my_user') ?>" class="flex items-center mt-4 py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-gray-100">Nasabah</a>
                        <a href="<?= base_url('agent/transactions') ?>" class="flex items-center mt-4 py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-gray-100">Transaksi</a>
                        <a href="<?= base_url('agent/profile') ?>" class="flex items-center mt-4 py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-gray-100">Profil</a>
                        <a href="<?= base_url('home/logout') ?>" class="flex items-center mt-4 py-2 px-6 text-gray-300 hover:bg-gray-700 hover:text-gray-100">Logout</a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="md:pl-64 flex flex-col flex-1">
            <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button @click="sidebarOpen = true" type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>
                <div class="flex-1 px-4 flex justify-between items-center">
                    <h1 class="text-xl font-bold">Selamat Datang, <?= $this->session->userdata('name'); ?>!</h1>
                </div>
            </div>

            <main class="flex-1">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <?php $this->load->view($view_name); ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>