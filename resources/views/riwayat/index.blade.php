<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Saya
        </h2>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto px-6" x-data="{ tab: 'menerima' }">
        <!-- Tab Navigation -->
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg p-1 shadow-md border">
                <button
                    @click="tab = 'menerima'"
                    :class="tab === 'menerima' ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-50'"
                    class="px-6 py-3 rounded-md font-medium transition-colors">
                    Menerima
                </button>
                <button
                    @click="tab = 'donasi'"
                    :class="tab === 'donasi' ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-50'"
                    class="px-6 py-3 rounded-md font-medium transition-colors">
                    Donasi
                </button>
            </div>
        </div>

        <!-- Riwayat Menerima -->
        <div x-show="tab === 'menerima'" class="space-y-4">
            @forelse ($riwayatMenerima as $item)
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md hover:border-gray-300 transition-all">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                        {{ $item->donasi->nama_makanan }}
                                    </h3>
                                    <span class="inline-block bg-blue-50 text-blue-700 text-sm px-3 py-1 rounded-md font-medium">
                                        {{ $item->donasi->kategori }}
                                    </span>
                                </div>
                                <span class="bg-green-50 text-green-700 text-sm px-4 py-2 rounded-md font-medium border border-green-200">
                                    Selesai
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-md border">
                                    <p class="text-sm text-gray-600 font-medium mb-1">Jumlah Diterima</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $item->jumlah_diambil }} Porsi</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-md border">
                                    <p class="text-sm text-gray-600 font-medium mb-1">Tanggal Pengambilan</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal_ambil)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8V4a1 1 0 00-1-1H9a1 1 0 00-1 1v1m4 0h2m-6 0v3a1 1 0 001 1h2a1 1 0 001-1V5m-6 3V8a1 1 0 011-1h2a1 1 0 011 1v0"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada riwayat penerimaan</h3>
                    <p class="text-gray-500">Anda belum pernah menerima donasi makanan</p>
                </div>
            @endforelse
        </div>

        <!-- Riwayat Donasi -->
        <div x-show="tab === 'donasi'" class="space-y-4">
            @forelse ($riwayatDonasi as $item)
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md hover:border-gray-300 transition-all">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                        {{ $item->nama_makanan }}
                                    </h3>
                                    <span class="inline-block bg-green-50 text-green-700 text-sm px-3 py-1 rounded-md font-medium">
                                        {{ $item->kategori }}
                                    </span>
                                </div>
                                <span class="bg-blue-50 text-blue-700 text-sm px-4 py-2 rounded-md font-medium border border-blue-200">
                                    Dibagikan
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-md border">
                                    <p class="text-sm text-gray-600 font-medium mb-1">Jumlah Didonasikan</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $item->jumlah }} Porsi</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-md border">
                                    <p class="text-sm text-gray-600 font-medium mb-1">Tanggal Kadaluarsa</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($item->kadaluwarsa)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada riwayat donasi</h3>
                    <p class="text-gray-500">Anda belum pernah melakukan donasi makanan</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>