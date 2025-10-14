<div x-data="{ addModal: false, editModal: false, deleteModal: false, selectedWaste: {} }">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Data Master: Jenis Sampah</h2>
            <button @click="addModal = true" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Jenis</button>
        </div>

        <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4">Nama Jenis</th>
                    <th class="py-2 px-4">Harga per Kg</th>
                    <th class="py-2 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($waste_types as $wt): ?>
                <tr class="border-b">
                    <td class="py-2 px-4"><?= htmlspecialchars($wt['nama_jenis']); ?></td>
                    <td class="py-2 px-4">Rp <?= number_format($wt['harga_per_kg'], 0, ',', '.'); ?></td>
                    <td class="py-2 px-4">
                        <button @click="editModal = true; selectedWaste = <?= htmlspecialchars(json_encode($wt)); ?>" class="text-yellow-500 hover:underline mr-2">Edit</button>
                        <a href="<?= base_url('admin/delete_waste_type/' . $wt['id_jenis']) ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-500 hover:underline">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div x-show="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click.away="addModal = false">
        <div @click.stop class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
            <h3 class="text-xl font-bold mb-4">Tambah Jenis Sampah</h3>
            <form action="<?= base_url('admin/add_waste_type') ?>" method="POST">
                <div class="mb-4">
                    <label class="block mb-2">Nama Jenis</label>
                    <input type="text" name="nama_jenis" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Harga per Kg</label>
                    <input type="number" name="harga_per_kg" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="addModal = false" class="bg-gray-300 px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click.away="editModal = false">
        <div @click.stop class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
            <h3 class="text-xl font-bold mb-4">Edit Jenis Sampah</h3>
            <form :action="'<?= base_url('admin/edit_waste_type/') ?>' + selectedWaste.id_jenis" method="POST">
                <div class="mb-4">
                    <label class="block mb-2">Nama Jenis</label>
                    <input type="text" name="nama_jenis" x-model="selectedWaste.nama_jenis" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Harga per Kg</label>
                    <input type="number" name="harga_per_kg" x-model="selectedWaste.harga_per_kg" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="editModal = false" class="bg-gray-300 px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>