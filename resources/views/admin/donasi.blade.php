@extends('layouts.admin')

@section('title', 'Data Donasi')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Donasi</h1>

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
    <input type="text" id="searchInput" placeholder="Cari donasi..." class="p-2 border border-gray-300 rounded w-full sm:w-1/3">
</div>

<div class="bg-white shadow rounded overflow-x-auto">
    <table id="donasiTable" class="min-w-full divide-y divide-gray-300 border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Makanan</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Halal</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kadaluwarsa</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="donasiTableBody">
            @foreach ($donasis as $i => $donasi)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-2 whitespace-nowrap">{{ $i + 1 }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $donasi->nama_makanan }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $donasi->kategori }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $donasi->jumlah }} porsi</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $donasi->halal }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $donasi->kadaluwarsa }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $donasi->alamat }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if (\Carbon\Carbon::parse($donasi->kadaluwarsa)->isPast())
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Selesai</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Belum Selesai</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if ($donasi->gambar)
                            <img src="{{ asset('storage/' . $donasi->gambar) }}" alt="Gambar Makanan" class="w-20 h-auto rounded">
                        @else
                            <span class="text-gray-400 text-sm italic">Tidak ada gambar</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="noDataMessage" class="hidden text-center py-4 text-sm text-gray-500">Data tidak ditemukan.</div>
</div>

<script>
    const entriesSelect = document.getElementById('entries');
    const table = document.getElementById('donasiTable');
    const tableBody = document.getElementById('donasiTableBody');
    const allRows = [...tableBody.rows];

    function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const entries = parseInt(entriesSelect.value);
        let visibleCount = 0;

        allRows.forEach((row, index) => {
            const match = [...row.cells].some(td => td.textContent.toLowerCase().includes(search));
            if (match && visibleCount < entries) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('noDataMessage').classList.toggle('hidden', visibleCount > 0);
    }

    entriesSelect.addEventListener('change', filterTable);
    document.getElementById('searchInput').addEventListener('input', filterTable);
    window.addEventListener('DOMContentLoaded', filterTable);
</script>
@endsection