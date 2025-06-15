<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Donasi') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ open: false, selectedDonasi: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Donasi</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse ($donasis as $donasi)
                        <div 
                            class="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition-shadow duration-300"
                            @click="open = true; selectedDonasi = {{ $donasi->toJson() }}"
                        >
                            @if ($donasi->gambar)
                                <img src="{{ asset('storage/' . $donasi->gambar) }}" alt="Foto Makanan"
                                    class="w-full h-40 object-cover rounded-t-xl">
                            @else
                                <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                                    Tidak ada foto
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="text-md font-semibold text-gray-900">{{ $donasi->nama_makanan }}</h3>
                                <p class="text-sm text-gray-600">{{ $donasi->alamat }}</p>
                                <p class="text-sm text-gray-600">Jumlah: {{ $donasi->jumlah }}</p>
                                <p class="text-sm text-gray-600">Status Halal: 
                                    <span class="{{ strtolower($donasi->halal) === 'halal' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $donasi->halal }}
                                    </span>
                                </p>
                                @php
                                    $kadaluwarsa = \Carbon\Carbon::parse($donasi->kadaluwarsa);
                                    $today = \Carbon\Carbon::today();
                                    $diffInDays = $today->diffInDays($kadaluwarsa, false);
                                @endphp
                                <p class="text-sm text-gray-500">
                                    Kadaluarsa: 
                                    @if ($kadaluwarsa->isToday())
                                        <span class="text-orange-600 font-medium">Hari ini</span>
                                    @elseif ($kadaluwarsa->isTomorrow())
                                        <span class="text-yellow-600">Besok</span>
                                    @elseif ($diffInDays > 1)
                                        {{ $diffInDays }} hari lagi
                                    @elseif ($diffInDays === 1)
                                        Besok
                                    @elseif ($diffInDays === -1)
                                        <span class="text-red-600">Kemarin</span>
                                    @elseif ($diffInDays < -1)
                                        <span class="text-red-600">Sudah lewat {{ abs($diffInDays) }} hari</span>
                                    @else
                                        {{ $kadaluwarsa->translatedFormat('d M Y') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada donasi hari ini.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Modal Detail Donasi -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" 
             @click="open = false"
             style="display: none;">
            
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                     @click.stop>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="w-full">
                                <!-- Header Modal -->
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Detail Donasi Makanan
                                    </h3>
                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Gambar -->
                                <div class="mb-4" x-show="selectedDonasi.gambar">
                                    <img :src="selectedDonasi.gambar ? `/storage/${selectedDonasi.gambar}` : ''" 
                                         :alt="selectedDonasi.nama_makanan"
                                         class="w-full h-48 object-cover rounded-lg">
                                </div>
                                
                                <!-- Detail Informasi -->
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Makanan</label>
                                        <p class="text-sm text-gray-900" x-text="selectedDonasi.nama_makanan"></p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                        <p class="text-sm text-gray-900" x-text="selectedDonasi.alamat"></p>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                            <p class="text-sm text-gray-900" x-text="selectedDonasi.jumlah"></p>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Status Halal</label>
                                            <p class="text-sm" 
                                               :class="selectedDonasi.halal && selectedDonasi.halal.toLowerCase() === 'halal' ? 'text-green-600' : 'text-red-600'"
                                               x-text="selectedDonasi.halal"></p>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kadaluarsa</label>
                                        <p class="text-sm text-gray-900" x-text="selectedDonasi.kadaluwarsa"></p>
                                    </div>
                                    
                                    <div x-show="selectedDonasi.deskripsi_makanan">
                                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                        <p class="text-sm text-gray-900" x-text="selectedDonasi.deskripsi_makanan"></p>
                                    </div>
                                    
                                    <div x-show="selectedDonasi.kontak">
                                        <label class="block text-sm font-medium text-gray-700">Kontak</label>
                                        <p class="text-sm text-gray-900" x-text="selectedDonasi.kontak"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer Modal -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <!-- Tombol Ambil Donasi -->
                        <a :href="'/form-penerima/' + selectedDonasi.id"
                           class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Ambil Donasi
                        </a>
                        
                        <button @click="open = false" 
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Tutup
                        </button>
                        
                        <!-- Tombol kontak (opsional) -->
                        <a :href="selectedDonasi.kontak ? `tel:${selectedDonasi.kontak}` : '#'" 
                           x-show="selectedDonasi.kontak"
                           class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Hubungi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>