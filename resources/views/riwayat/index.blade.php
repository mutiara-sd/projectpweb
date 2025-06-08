<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Saya
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4" x-data="{ tab: 'menerima' }">
        <!-- Tab Navigation -->
        <div class="flex justify-center mb-6">
            <button
                @click="tab = 'menerima'"
                :class="tab === 'menerima' ? 'bg-blue-600 text-white shadow' : 'bg-gray-200 text-gray-600'"
                class="px-6 py-2 rounded-full font-medium transition-all duration-200 mx-2">
                Menerima
            </button>
            <button
                @click="tab = 'donasi'"
                :class="tab === 'donasi' ? 'bg-blue-600 text-white shadow' : 'bg-gray-200 text-gray-600'"
                class="px-6 py-2 rounded-full font-medium transition-all duration-200 mx-2">
                Donasi
            </button>
        </div>

        <!-- Riwayat Menerima -->
        <div x-show="tab === 'menerima'" class="space-y-4">
            @forelse ($riwayatMenerima as $item)
                <div class="bg-gradient-to-r from-white to-blue-50 border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                🍽️ {{ $item->donasi->nama_makanan }}
                            </h3>
                            <p class="text-sm text-gray-600">Kategori: {{ $item->donasi->kategori }}</p>
                            <p class="text-sm text-gray-600">Jumlah: {{ $item->jumlah_diambil }} Porsi</p>
                            <p class="text-sm text-gray-600">Tanggal Ambil: {{ \Carbon\Carbon::parse($item->tanggal_ambil)->format('d M Y') }}</p>
                        </div>
                        <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full font-medium">Selesai</span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada riwayat penerimaan donasi.</p>
            @endforelse
        </div>

        <!-- Riwayat Donasi -->
        <div x-show="tab === 'donasi'" class="space-y-4">
            @forelse ($riwayatDonasi as $item)
                <div class="bg-gradient-to-r from-white to-green-50 border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                🥗 {{ $item->nama_makanan }}
                            </h3>
                            <p class="text-sm text-gray-600">Kategori: {{ $item->kategori }}</p>
                            <p class="text-sm text-gray-600">Jumlah: {{ $item->jumlah }} Porsi</p>
                            <p class="text-sm text-gray-600">Kadaluarsa: {{ \Carbon\Carbon::parse($item->kadaluwarsa)->format('d M Y') }}</p>
                        </div>
                        <span class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full font-medium">Dibagikan</span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada riwayat donasi.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
