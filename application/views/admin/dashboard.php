<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h4 class="text-gray-600">Total Nasabah</h4>
        <p class="text-3xl font-bold"><?= $total_users; ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h4 class="text-gray-600">Total Agen</h4>
        <p class="text-3xl font-bold"><?= $total_agents; ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h4 class="text-gray-600">Total Sampah (Kg)</h4>
        <p class="text-3xl font-bold"><?= number_format($total_waste, 2); ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h4 class="text-gray-600">Transaksi (Rp)</h4>
        <p class="text-3xl font-bold">N/A</p> </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Persetujuan Agen Baru</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-left text-sm">
                            <th class="py-2 px-4">Nama</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Wilayah</th>
                            <th class="py-2 px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($pending_agents)): ?>
                            <tr><td colspan="4" class="text-center py-4 text-gray-500">Tidak ada pendaftaran baru.</td></tr>
                        <?php else: ?>
                            <?php foreach($pending_agents as $agent): ?>
                            <tr class="border-b">
                                <td class="py-2 px-4"><?= htmlspecialchars($agent['name']); ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($agent['email']); ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($agent['wilayah']); ?></td>
                                <td class="py-2 px-4 whitespace-nowrap">
                                    <a href="<?= base_url('admin/approve_agent/' . $agent['id_agent']) ?>" class="bg-green-500 text-white px-3 py-1 text-xs rounded hover:bg-green-600">Setujui</a>
                                    <a href="<?= base_url('admin/reject_agent/' . $agent['id_agent']) ?>" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Tolak</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Aktivitas Terbaru</h2>
            </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Tren Sampah (6 Bulan Terakhir)</h2>
        <canvas id="wasteTrendChart"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('wasteTrendChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $chart_labels; ?>,
            datasets: [{
                label: 'Total Sampah (Kg)',
                data: <?= $chart_data; ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>