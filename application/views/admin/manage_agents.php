<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Manajemen Agen (Bank Sampah)</h2>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4">Nama</th>
                    <th class="py-2 px-4">Wilayah</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($agents as $agent): ?>
                <tr class="border-b">
                    <td class="py-2 px-4"><?= htmlspecialchars($agent['name']); ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($agent['wilayah']); ?></td>
                    <td class="py-2 px-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            <?php if($agent['status'] == 'aktif'): ?> bg-green-100 text-green-800 <?php endif; ?>
                            <?php if($agent['status'] == 'pending'): ?> bg-yellow-100 text-yellow-800 <?php endif; ?>
                            <?php if($agent['status'] == 'nonaktif'): ?> bg-red-100 text-red-800 <?php endif; ?>
                        ">
                            <?= ucfirst($agent['status']); ?>
                        </span>
                    </td>
                    <td class="py-2 px-4">
                        <a href="#" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>