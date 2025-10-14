<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Manajemen Nasabah</h2>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4">Nama</th>
                    <th class="py-2 px-4">Email</th>
                    <th class="py-2 px-4">Telepon</th>
                    <th class="py-2 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr class="border-b">
                    <td class="py-2 px-4"><?= htmlspecialchars($user['name']); ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($user['email']); ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($user['phone']); ?></td>
                    <td class="py-2 px-4">
                        <a href="#" class="text-blue-500 hover:underline">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>