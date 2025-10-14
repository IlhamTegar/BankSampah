<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div>
    <!-- Header Sambutan -->
    <h2 class="text-2xl font-bold text-gray-800">Welcome back, <?= htmlspecialchars($this->session->userdata('name')); ?>!</h2>
    <p class="text-gray-600 mb-6">Here's your waste collection summary and recent activity.</p>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h6 class="text-gray-500 font-medium">Total Saldo</h6>
            <h4 class="text-3xl font-bold mt-1">Rp <?= isset($balance) ? number_format($balance, 0, ',', '.') : '0'; ?></h4>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h6 class="text-gray-500 font-medium">Total Setoran</h6>
            <h4 class="text-3xl font-bold mt-1"><?= isset($total_transactions) ? $total_transactions : '0'; ?></h4>
            <small class="text-green-500">+3 bulan ini</small> <!-- Contoh data statis -->
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h6 class="text-gray-500 font-medium">Poin Didapat</h6>
            <h4 class="text-3xl font-bold mt-1">1,240</h4> <!-- Contoh data statis -->
            <small class="text-green-500">+180 minggu ini</small> <!-- Contoh data statis -->
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h6 class="text-gray-500 font-medium">Target Bulanan</h6>
            <h4 class="text-3xl font-bold mt-1">78%</h4> <!-- Contoh data statis -->
            <small class="text-gray-500">22% tersisa</small> <!-- Contoh data statis -->
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white p-6 rounded-xl shadow-sm mb-6">
        <h5 class="text-xl font-bold">Aktivitas Terbaru</h5>
        <p class="text-gray-500 mb-4">Setoran sampah terakhir Anda.</p>
        <div class="space-y-3">
            <?php if (empty($transactions)): ?>
                <div class="text-center text-gray-500 py-4">Belum ada aktivitas.</div>
            <?php else: ?>
                <?php foreach($transactions as $trx): ?>
                <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition">
                    <div>
                        <strong class="font-medium">Setoran</strong> - <span class="text-gray-600"><?= date('d M Y', strtotime($trx['tanggal_setor'])); ?></span>
                    </div>
                    <span>
                        Rp <?= number_format($trx['total_setoran'], 0, ',', '.'); ?> 
                        <small class="text-gray-500">ke <?= htmlspecialchars($trx['agent_name'] ?? 'N/A'); ?></small>
                    </span>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Aksi Cepat -->
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h5 class="text-xl font-bold">Aksi Cepat</h5>
        <p class="text-gray-500 mb-4">Kelola pengumpulan sampah Anda.</p>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="#" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 text-center font-medium transition">Jadwalkan Penjemputan</a>
            <a href="<?= base_url('user/waste_banks') ?>" class="bg-green-100 text-green-800 px-4 py-2 rounded-lg hover:bg-green-200 text-center font-medium transition">Cari Bank Sampah</a>
            <a href="#" class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg hover:bg-yellow-200 text-center font-medium transition">Tukar Poin</a>
        </div>
    </div>
</div>

