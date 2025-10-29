<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div x-data="{ loginModal: false, registerModal: false, registerRole: '', mobileMenuOpen: false }">

    <header class="bg-white shadow-md fixed w-full z-20 md:hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="<?= base_url() ?>" class="text-2xl font-bold text-gray-800">Bank Sampah</a> </div>
                <div>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden bg-white border-t">
            <nav class="px-2 pt-2 pb-4 space-y-1">
                <button @click="loginModal = true; mobileMenuOpen = false" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Masuk</button> <button @click="registerModal = true; registerRole = 'user'; mobileMenuOpen = false" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Daftar Nasabah</button> <button @click="registerModal = true; registerRole = 'agent'; mobileMenuOpen = false" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Daftar Agen</button> </nav>
        </div>
    </header>

    <section class="relative bg-gray-900 text-white" style="background: url('https://images.unsplash.com/photo-1501594907352-04cda38ebc29') no-repeat center center; background-size: cover; height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center py-24 px-4">
            <?php if($this->session->flashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-md mx-auto mb-4" role="alert">
                    <span class="block sm:inline"><?= $this->session->flashdata('success'); ?></span>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-md mx-auto mb-4">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">Bank Sampah</h1> <p class="mb-6 max-w-2xl mx-auto">Ubah sampah Anda menjadi nilai. Bergabunglah dengan komunitas pengumpul dan agen kami yang bekerja sama untuk kota yang lebih bersih.</p> <div class="hidden md:block">
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <button @click="registerModal = true; registerRole = 'user'" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold">Daftar sebagai Nasabah</button> <button @click="registerModal = true; registerRole = 'agent'" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">Daftar sebagai Agen</button> </div>
                <p class="mt-4">
                    Sudah punya akun? <button @click="loginModal = true" class="underline font-semibold hover:text-green-300">Masuk</button> </p>
            </div>

            <p class="mt-2">
                <a href="#impact" class="underline hover:text-green-300">Lihat Statistik</a> </p>
        </div>
    </section>

    <?php $this->load->view('partials/modal_auth'); // Pastikan modal_auth juga diterjemahkan jika perlu ?>

    <section id="impact" class="py-16 text-center bg-gray-50">
        <h2 class="text-3xl font-bold mb-4">Dampak Kami Sejauh Ini</h2> <p class="text-gray-600 mb-10 max-w-2xl mx-auto px-4">Lihat bagaimana komunitas kami membuat perbedaan.</p> <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
            <div class="bg-white p-6 rounded-xl shadow text-center flex flex-col justify-between">
                <div>
                    <div class="text-3xl">♻️</div>
                    <h3 class="text-xl font-bold"><?= number_format($summary['total_waste'], 2); ?> kg</h3>
                    <p class="text-gray-600">Total Sampah Terkumpul</p> </div>
                <button onclick="toggleDetail('wasteDetail')" class="mt-4 text-blue-600 underline">Lihat Detail</button> </div>
            <div class="bg-white p-6 rounded-xl shadow text-center flex flex-col justify-between">
                <div>
                    <div class="text-3xl">🙋‍♂️🙋‍♀️</div> <h3 class="text-xl font-bold"><?= $summary['total_customers']; // Pastikan variabel ini benar ?></h3>
                    <p class="text-gray-600">Total Nasabah Terdaftar</p>
                </div>
                <button onclick="toggleDetail('customerDetail')" class="mt-4 text-blue-600 underline">Lihat Detail</button> </div>
            <div class="bg-white p-6 rounded-xl shadow text-center flex flex-col justify-between">
                <div>
                    <div class="text-3xl">👥</div>
                    <h3 class="text-xl font-bold"><?= $summary['active_agents']; ?></h3>
                    <p class="text-gray-600">Agen Aktif</p> </div>
                <button onclick="toggleDetail('agentDetail')" class="mt-4 text-blue-600 underline">Lihat Detail</button> </div>
            <div class="bg-white p-6 rounded-xl shadow text-center flex flex-col justify-between">
                <div>
                    <div class="text-3xl">💰</div>
                    <h3 class="text-xl font-bold">Harga Sampah Terkini</h3> <ul class="text-sm text-gray-600 mt-2 space-y-1">
                        <?php foreach($latest_prices as $price): ?>
                            <li><?= htmlspecialchars($price['nama_jenis']) ?>: Rp <?= number_format($price['harga']) ?>/kg</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <button onclick="toggleDetail('priceDetail')" class="mt-4 text-blue-600 underline">Lihat Detail</button> </div>
        </div>
    </section>

    <div id="wasteDetail" class="hidden max-w-5xl mx-auto bg-white p-6 -mt-8 mb-6 rounded-xl shadow relative z-10">
        <h3 class="text-xl font-bold mb-4 text-center">Rincian Statistik Sampah</h3> <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div class="flex justify-center items-center h-64 md:h-80">
                <canvas id="wastePieChart"></canvas>
            </div>
            <div class="h-64 md:h-80">
                <canvas id="wasteBarChart"></canvas>
            </div>
        </div>
    </div>

    <div id="agentDetail" class="hidden max-w-5xl mx-auto bg-white p-6 -mt-8 mb-6 rounded-xl shadow relative z-10">
        <h3 class="text-xl font-bold mb-4 text-center">Distribusi Agen per Wilayah</h3> <div class="h-80">
            <canvas id="agentDistributionChart"></canvas>
        </div>
    </div>

    <div id="customerDetail" class="hidden max-w-5xl mx-auto bg-white p-6 -mt-8 mb-6 rounded-xl shadow relative z-10">
        <h3 class="text-xl font-bold mb-4 text-center">Distribusi Nasabah per Wilayah Agen</h3>
        <div class="h-80"> <canvas id="customerDistributionChart"></canvas>
        </div>
    </div>

    <div id="priceDetail" class="hidden max-w-5xl mx-auto bg-white p-6 -mt-8 mb-6 rounded-xl shadow relative z-10">
        <h3 class="text-xl font-bold mb-4 text-center">Grafik Harga Sampah per Kategori</h3> <div class="h-96">
            <canvas id="wastePriceChart"></canvas>
        </div>
    </div>

    <section id="statistics" class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-2xl font-bold mb-4 text-center">Daftar Bank Sampah / Agen</h3> <div class="overflow-x-auto rounded-lg shadow">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border-b px-4 py-3 text-left">Nama</th> <th class="border-b px-4 py-3 text-left">Wilayah</th> <th class="border-b px-4 py-3 text-center">Status</th> </tr>
                    </thead>
                    <tbody>
                        <?php foreach($agents as $a): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border-b px-4 py-3"><?= htmlspecialchars($a['name']); ?></td>
                            <td class="border-b px-4 py-3"><?= htmlspecialchars($a['area']); ?></td>
                            <td class="border-b px-4 py-3 text-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full <?= $a['status'] == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                    <?= ucfirst($a['status'] == 'aktif' ? 'Aktif' : 'Pending'); ?> </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-2xl font-bold mb-4 text-center">Peta Persebaran Agen</h3> <div id="map" class="w-full h-96 rounded-lg shadow-md"></div>
        </div>
    </section>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    /**
     * FUNGSI TOGGLE DIPERBAIKI
     * Fungsi ini sekarang akan menutup detail lain saat satu dibuka,
     * dan akan menutup detail yang aktif jika tombolnya diklik lagi.
     */
    function toggleDetail(id) {
        // Tambahkan 'customerDetail' ke dalam array ini
        const allDetails = ['wasteDetail', 'agentDetail', 'customerDetail', 'priceDetail'];
        const targetElement = document.getElementById(id);

        if (!targetElement) {
             console.error(`Element with ID "${id}" not found.`); // Pesan error jika ID tidak ada
             return;
        }

        // Cek apakah elemen yang diklik sudah terlihat sebelum proses
        const isAlreadyVisible = !targetElement.classList.contains('hidden');

        // Selalu sembunyikan semua detail terlebih dahulu
        allDetails.forEach(detailId => {
             const detailElement = document.getElementById(detailId);
             if (detailElement) { // Hanya sembunyikan jika elemennya ada
                 detailElement.classList.add('hidden');
             } else {
                 console.warn(`Detail element with ID "${detailId}" not found during hide process.`);
             }
        });

        // Jika elemen yang diklik TADI BELUM TERLIHAT, maka sekarang tampilkan
        if (!isAlreadyVisible) {
            targetElement.classList.remove('hidden');
            // Scroll ke elemen detail (opsional, untuk UX yang lebih baik)
             targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
    window.toggleDetail = toggleDetail; // Membuat fungsi bisa dipanggil dari HTML (onclick)

    // Data dari PHP (Pastikan semua variabel ini dikirim dari Controller Home.php)
    const wasteLabels = <?= json_encode(array_column($waste_stats ?? [], 'name')); ?>;
    const wasteData = <?= json_encode(array_column($waste_stats ?? [], 'amount')); ?>;
    const months = <?= json_encode(array_column($monthly_stats ?? [], 'month')); ?>;
    const monthData = <?= json_encode(array_column($monthly_stats ?? [], 'amount')); ?>;
    const agentDistributionLabels = <?= $agent_distribution_labels ?? '[]'; ?>;
    const agentDistributionData = <?= $agent_distribution_data ?? '[]'; ?>;
    const customerDistributionLabels = <?= $customer_distribution_labels ?? '[]'; ?>; // Data Nasabah
    const customerDistributionData = <?= $customer_distribution_data ?? '[]'; ?>;   // Data Nasabah
    const priceChartLabels = <?= $price_chart_labels ?? '[]'; ?>;
    const priceChartCurrent = <?= $price_chart_current ?? '[]'; ?>;
    const priceChartPrevious = <?= $price_chart_previous ?? '[]'; ?>;

    // Chart Pie Sampah
    const pieCtx = document.getElementById("wastePieChart");
    if(pieCtx && wasteLabels.length > 0) { // Hanya buat chart jika ada data
        new Chart(pieCtx, {
            type: "pie",
            data: {
                labels: wasteLabels,
                datasets: [{ data: wasteData, backgroundColor: ["#f87171", "#60a5fa", "#34d399", "#fbbf24", "#d971f8ff"] }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // Chart Bar Sampah Bulanan
    const barCtx = document.getElementById("wasteBarChart");
    if (barCtx && months.length > 0) {
        new Chart(barCtx, {
            type: "bar",
            data: {
                labels: months,
                datasets: [{ label: "Total Sampah (kg)", data: monthData, backgroundColor: "#34d399" }]
            },
             options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } } // Tambahkan options
        });
    }

    // Chart Bar Persebaran Agen
    const agentCtx = document.getElementById("agentDistributionChart");
    if(agentCtx && agentDistributionLabels.length > 0) {
        new Chart(agentCtx, {
            type: 'bar',
            data: {
                labels: agentDistributionLabels,
                datasets: [{ label: 'Jumlah Agen', data: agentDistributionData, backgroundColor: 'rgba(59, 130, 246, 0.5)', borderColor: 'rgba(59, 130, 246, 1)', borderWidth: 1 }]
            },
            options: { indexAxis: 'x', responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
        });
    }

     // Chart Bar Persebaran Nasabah
    const customerCtx = document.getElementById("customerDistributionChart");
    if (customerCtx && customerDistributionLabels.length > 0) {
        new Chart(customerCtx, {
            type: 'bar',
            data: {
                labels: customerDistributionLabels,
                datasets: [{
                    label: 'Jumlah Nasabah',
                    data: customerDistributionData,
                    backgroundColor: 'rgba(251, 146, 60, 0.5)', // Warna berbeda
                    borderColor: 'rgba(251, 146, 60, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'x',
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                 plugins: { title: { display: true, text: 'Distribusi Nasabah Berdasarkan Wilayah Agen Pilihan' } }
            }
        });
    }

    // Chart Garis Harga Sampah
    const priceCtx = document.getElementById("wastePriceChart");
    if(priceCtx && priceChartLabels.length > 0) {
        new Chart(priceCtx, {
            type: 'line',
            data: {
                labels: priceChartLabels,
                datasets: [
                    {
                        label: 'Harga Minggu Ini (Rp)',
                        data: priceChartCurrent,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        tension: 0.1
                    },
                    {
                        label: 'Harga Minggu Lalu (Rp)',
                        data: priceChartPrevious,
                        borderColor: 'rgb(209, 213, 219)',
                        backgroundColor: 'rgba(209, 213, 219, 0.5)',
                        tension: 0.1,
                        borderDash: [5, 5]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); } }
                    }
                }
            }
        });
    }

    // Inisialisasi Peta Leaflet
    const mapElement = document.getElementById("map");
    if (mapElement) {
        const defaultLat = -1.86667; // Pusat Indonesia (perkiraan)
        const defaultLng = 114.73333;
        const map = L.map("map").setView([defaultLat, defaultLng], 5); // Zoom out sedikit
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", { maxZoom: 19 }).addTo(map);

        // Ambil data agen dari PHP (pastikan ada di view)
        const agentsData = <?= json_encode($agents ?? []); ?>;

        agentsData.forEach(agent => {
            if (agent.lat && agent.lng) { // Pastikan lat & lng ada
                L.marker([agent.lat, agent.lng])
                 .addTo(map)
                 .bindPopup(`<b>${agent.name}</b><br>${agent.area}`);
            }
        });

        // Invalidate map size setelah beberapa saat
        setTimeout(() => { map.invalidateSize(); }, 400);
    }

}); // Akhir DOMContentLoaded
</script>