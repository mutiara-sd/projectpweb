<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Donasi') }}
        </h2>
    </x-slot>

    <!-- MULAI X-DATA -->
    <div x-data="{ 
        open: false, 
        selectedDonasi: {},
        openModal: function(donasi) {
            this.selectedDonasi = donasi;
            this.open = true;
            console.log('Modal opened with data:', donasi);
        }
    }">

        <!-- Enhanced Donasi Makanan Section -->
        <section class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex flex-wrap justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Donasi</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full"></div>
                </div>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg mb-8">
                <p class="text-sm text-blue-700">
                    <span class="font-semibold">Info:</span> Hanya donasi dari pengguna lain yang ditampilkan. 
                    Donasi milikmu bisa dilihat di 
                    <a href="{{ route('riwayat.index') }}" class="font-semibold underline hover:text-blue-800">Riwayat Donasi</a>.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($donasis as $donasi)
                    @php
                        $kadaluwarsa = \Carbon\Carbon::parse($donasi->kadaluwarsa);
                        $today = \Carbon\Carbon::today();
                        $diffInDays = $today->diffInDays($kadaluwarsa, false);
                    @endphp

                    @if ($kadaluwarsa->toDateString() < $today->toDateString())
                        @continue
                    @endif

                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl border border-gray-100 overflow-hidden cursor-pointer group transition-all duration-300"
                        @click="openModal({{ Js::from([
                            'id' => $donasi->id,
                            'nama_makanan' => $donasi->nama_makanan,
                            'alamat' => $donasi->alamat,
                            'jumlah' => $donasi->jumlah,
                            'kadaluwarsa' => $donasi->kadaluwarsa,
                            'halal' => $donasi->halal ? 'Halal' : 'Tidak Halal',
                            'gambar' => $donasi->gambar,
                            'kadaluwarsa_formatted' => $kadaluwarsa->translatedFormat('Y-m-d'),
                        ]) }})">
                        
                        <div class="relative overflow-hidden">
                            @if ($donasi->gambar)
                                <img src="{{ asset('storage/' . $donasi->gambar) }}" alt="Foto Makanan"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <div class="text-center text-gray-400">
                                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm">Tidak ada foto</span>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $donasi->halal ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                    {{ $donasi->halal ? 'Halal' : 'Tidak Halal' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">{{ $donasi->nama_makanan }}</h3>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $donasi->alamat }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                    </svg>
                                    <span>Jumlah: {{ $donasi->jumlah }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>
                                        @if ($kadaluwarsa->isToday())
                                            <span class="text-orange-600 font-semibold">Kadaluarsa hari ini</span>
                                        @elseif ($kadaluwarsa->isTomorrow())
                                            <span class="text-yellow-600 font-semibold">Kadaluarsa besok</span>
                                        @elseif ($diffInDays > 1)
                                            Kadaluarsa {{ $diffInDays }} hari lagi
                                        @else
                                            Kadaluarsa {{ $kadaluwarsa->translatedFormat('d M Y') }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <button class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-2 px-4 rounded-xl text-sm transition-all duration-300 transform hover:scale-105">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Tidak ada donasi makanan tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Enhanced Modal Detail Donasi -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 overflow-y-auto" 
                 style="display: none;">
                
                <!-- Background Overlay -->
                <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40" @click="open = false"></div>
                
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center relative z-50">
                    <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-200"
                         @click.stop>
                        
                        <!-- Modal Header with gradient -->
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-bold text-white">
                                    Detail Donasi Makanan
                                </h3>
                                <button @click="open = false" class="text-white hover:text-gray-200 hover:bg-white/20 rounded-full p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="bg-white px-6 py-6">
                            <!-- Gambar -->
                            <div class="mb-6" x-show="selectedDonasi.gambar">
                                <img :src="selectedDonasi.gambar ? `/storage/${selectedDonasi.gambar}` : ''" 
                                     :alt="selectedDonasi.nama_makanan"
                                     class="w-full h-64 object-cover rounded-xl shadow-lg">
                            </div>
                            
                            <!-- Detail Informasi dengan Card Style -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Makanan</label>
                                    <p class="text-lg font-semibold text-gray-900" x-text="selectedDonasi.nama_makanan"></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat</label>
                                    <p class="text-gray-900" x-text="selectedDonasi.alamat"></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah</label>
                                    <p class="text-gray-900" x-text="selectedDonasi.jumlah"></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Status Halal</label>
                                    <p class="font-semibold" 
                                       :class="selectedDonasi.halal ? 'text-green-600' : 'text-red-600'"
                                       x-text="selectedDonasi.halal ? 'Halal' : 'Tidak Halal'"></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Kadaluarsa</label>
                                    <p class="text-gray-900" x-text="selectedDonasi.kadaluwarsa"></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200" x-show="selectedDonasi.kontak">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Kontak</label>
                                    <p class="text-gray-900" x-text="selectedDonasi.kontak"></p>
                                </div>
                            </div>
                            
                            <div class="mt-6" x-show="selectedDonasi.deskripsi">
                                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                    <label class="block text-sm font-bold text-blue-700 mb-2">Deskripsi</label>
                                    <p class="text-blue-900" x-text="selectedDonasi.deskripsi"></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Enhanced Footer Modal -->
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
                            <!-- Tombol Ambil Donasi -->
                            <a :href="'/form-penerima/' + selectedDonasi.id"
                               class="inline-flex justify-center items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl border border-green-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Ambil Donasi
                            </a>
                            
                            <!-- Tombol kontak -->
                            <a :href="selectedDonasi.kontak ? `tel:${selectedDonasi.kontak}` : '#'" 
                               x-show="selectedDonasi.kontak"
                               class="inline-flex justify-center items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl border border-blue-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Hubungi
                            </a>
                            
                            <button @click="open = false" 
                                    class="inline-flex justify-center items-center px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl border border-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Carousel -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('carousel');
            const buttons = document.querySelectorAll('[data-slide]');
            let index = 0;

            function updateSlide() {
                carousel.style.transform = `translateX(-${index * 100}%)`;
                buttons.forEach((btn, i) => {
                    if (i === index) {
                        btn.classList.add('bg-white', 'scale-110');
                        btn.classList.remove('bg-white/70');
                    } else {
                        btn.classList.remove('bg-white', 'scale-110');
                        btn.classList.add('bg-white/70');
                    }
                });
            }

            setInterval(() => {
                index = (index + 1) % 4;
                updateSlide();
            }, 7000);

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    index = parseInt(btn.dataset.slide);
                    updateSlide();
                });
            });

            updateSlide();
        });
    </script>
</x-app-layout>