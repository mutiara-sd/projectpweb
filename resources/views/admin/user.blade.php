@extends('layouts.admin')

@section('title', 'Data User')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Pengguna</h1>

<div class="mb-4 flex flex-wrap justify-between items-center gap-3">
    <div class="flex items-center gap-2">
        <label for="entries" class="text-sm font-medium text-gray-700">Tampilkan</label>
        <select id="entries" class="border border-gray-300 rounded px-2 py-1 pr-6 text-sm">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="25">25</option>
        </select>
        <span class="text-sm">data per halaman</span>
    </div>
    <input type="text" id="searchInput" placeholder="Cari pengguna..." class="p-2 border border-gray-300 rounded w-full sm:w-1/3">
</div>

@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow rounded overflow-x-auto">
    <table id="userTable" class="min-w-full divide-y divide-gray-300 border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. Telepon</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Detail Lokasi</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="userTableBody">
            @foreach ($users as $i => $user)
                @if (!in_array($user->name, ['admin', 'penulis']))
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-2 whitespace-nowrap">
                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->no_telepon }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->lokasi->nama_lokasi ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->lokasi_detail }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @php
                            $isActive = $user->donasis()->where('created_at', '>=', now()->subDays(7))->exists() ||
                                        $user->penerimas()->where('created_at', '>=', now()->subDays(7))->exists();
                        @endphp
                        @if($isActive)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium space-x-2">
                        <button onclick="openDeleteModal('{{ route('admin.user.destroy', $user->id) }}')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                        <button onclick="openEditModal({{ $user }})" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-xs">Edit</button>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <div id="noDataMessage" class="hidden text-center py-4 text-sm text-gray-500">Data tidak ditemukan.</div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm mx-auto mt-40 shadow-lg">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="mb-6 text-sm text-gray-700">Yakin ingin menghapus user ini?</p>
        <div class="flex justify-end gap-2">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Update -->
<div id="updateConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm mx-auto mt-40 shadow-lg">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Perubahan</h2>
        <p class="mb-6 text-sm text-gray-700">Yakin ingin mengubah data user ini?</p>
        <div class="flex justify-end gap-2">
            <button onclick="closeUpdateModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
            <button onclick="submitEditForm()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden">
    <div class="w-full max-w-lg mx-auto mt-20 bg-white rounded-lg shadow-lg p-6 flex flex-col">
        <h2 class="text-lg font-bold mb-4">Edit Data Pengguna</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="editName" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="editName" class="form-input w-full" required>
                </div>
                <div>
                    <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="editEmail" class="form-input w-full" required>
                </div>
                <div>
                    <label for="editPhone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <input type="text" name="no_telepon" id="editPhone" class="form-input w-full" required>
                </div>
                <div>
                    <label for="editLokasiDetail" class="block text-sm font-medium text-gray-700">Detail Lokasi</label>
                    <input type="text" name="lokasi_detail" id="editLokasiDetail" class="form-input w-full">
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="button" onclick="showUpdateConfirm()" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(user) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editName').value = user.name;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editPhone').value = user.no_telepon;
        document.getElementById('editLokasiDetail').value = user.lokasi_detail;
        document.getElementById('editForm').action = `/admin/user/${user.id}`;
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDeleteModal(actionUrl) {
        document.getElementById('deleteConfirmModal').classList.remove('hidden');
        document.getElementById('deleteForm').action = actionUrl;
    }

    function closeDeleteModal() {
        document.getElementById('deleteConfirmModal').classList.add('hidden');
    }

    function showUpdateConfirm() {
        document.getElementById('updateConfirmModal').classList.remove('hidden');
    }

    function closeUpdateModal() {
        document.getElementById('updateConfirmModal').classList.add('hidden');
    }

    function submitEditForm() {
        document.getElementById('editForm').submit();
    }

    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        let visibleCount = 0;
        document.querySelectorAll('#userTable tbody tr').forEach(row => {
            const match = [...row.children].some(td => td.textContent.toLowerCase().includes(keyword));
            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });
        document.getElementById('noDataMessage').classList.toggle('hidden', visibleCount > 0);
    });
</script>
@endsection
