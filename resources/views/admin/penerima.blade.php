@extends('layouts.admin')

@section('title', 'Data Penerima Donasi')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Penerima Donasi</h1>

<div class="mb-4 flex flex-wrap justify-between items-center gap-3">
    <div class="flex items-center gap-2">
        <label for="entries" class="text-sm font-medium text-gray-700">Tampilkan</label>
        <select id="entries" class="border border-gray-300 rounded px-2 py-1 pr-6 text-sm">
            <option value="5" {{ request('entries') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('entries', 10) == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
        </select>
        <span class="text-sm">data per halaman</span>
    </div>
    <input type="text" id="searchInput" placeholder="Cari penerima..." class="p-2 border border-gray-300 rounded w-full sm:w-1/3">
</div>

<div class="bg-white shadow rounded overflow-x-auto">
    <table id="penerimaTable" class="min-w-full divide-y divide-gray-300 border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama User</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Makanan</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Porsi</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="penerimaTableBody">
            @foreach ($penerimas as $i => $penerima)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-2 whitespace-nowrap">
                        {{ ($penerimas->currentPage() - 1) * $penerimas->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penerima->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penerima->donasi->nama_makanan ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if (!is_null($penerima->jumlah_diambil) && $penerima->jumlah_diambil > 0)
                            {{ $penerima->jumlah_diambil }} porsi
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if (\Carbon\Carbon::parse($penerima->created_at)->addHours(6)->isPast())
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Selesai</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Belum Selesai</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $penerimas->appends(request()->query())->links() }}
</div>

<div id="noDataMessage" class="hidden text-center py-4 text-sm text-gray-500">Data tidak ditemukan.</div>

<script>
    document.getElementById('entries').addEventListener('change', function () {
        const params = new URLSearchParams(window.location.search);
        params.set('entries', this.value);
        window.location.search = params.toString();
    });

    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        let visibleCount = 0;
        document.querySelectorAll('#penerimaTable tbody tr').forEach(row => {
            const match = [...row.children].some(td => td.textContent.toLowerCase().includes(keyword));
            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });
        document.getElementById('noDataMessage').classList.toggle('hidden', visibleCount > 0);
    });
</script>
@endsection