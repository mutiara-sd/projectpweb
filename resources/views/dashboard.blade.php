<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6" x-data="{ open: false, selectedDonasi: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Message with Gradient -->
            <div class="relative bg-gradient-to-r from-blue-500 to-blue-300 text-white rounded-xl shadow-md p-6 overflow-hidden mb-6">
                <div class="relative z-10">
                    <div class="text-xl font-semibold">
                        Haii {{ Auth::user()->name }}! 
                    </div>
                    <div class="text-sm opacity-90 mt-1">
                        Terima kasih sudah terus berbagi kebaikan.
                    </div>
                    <div class="mt-4 flex justify-around text-sm font-medium">
                        <div class="text-center">
                            <div class="text-2xl font-bold">{{ $totalPenerimaan }}</div>
                            <div class="opacity-90">Menerima Donasi</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold">{{ $totalDonasi }}</div>
                            <div class="opacity-90">Donasi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slideshow -->
            <div class="relative overflow-hidden rounded-lg shadow-lg">
                <div id="carousel" class="flex w-full transition-transform duration-1000 ease-in-out">
                    @foreach (range(1, 4) as $i)
                        <div class="min-w-full h-64 md:h-96 relative">
                            <img src="{{ asset("images/slide{$i}.jpg") }}" class="w-full h-auto max-h-[600px] object-cover rounded-lg" alt="Slide {{ $i }}">
                        </div>
                    @endforeach
                </div>
                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 mt-2">
                    @foreach (range(0, 3) as $i)
                        <button class="w-3 h-3 rounded-full bg-white/70 hover:bg-white transition" data-slide="{{ $i }}"></button>
                    @endforeach
                </div>
            </div>

            <!-- Donasi Makanan -->
            <section class="mt-10 bg-gray-50 py-8 px-4 overflow-hidden shadow-sm rounded-xl">
                <div class="flex flex-wrap justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Donasi Makanan Terbaru</h2>
                    <a href="{{ route('donasi.hari-ini') }}" class="text-blue-600 hover:underline text-sm font-medium">
                        Lihat lainnya →
                    </a>
                </div>

                <p class="text-sm text-gray-500 italic mb-4">
                    Hanya donasi dari pengguna lain yang ditampilkan. 
                    Donasi milikmu bisa dilihat di 
                    <a href="{{ route('riwayat.index') }}" class="text-blue-600 underline hover:text-blue-800">Riwayat Donasi</a>.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse ($donasis as $donasi)
                        @php
                            $kadaluwarsa = \Carbon\Carbon::parse($donasi->kadaluwarsa);
                            $today = \Carbon\Carbon::today();
                            $diffInDays = $today->diffInDays($kadaluwarsa, false);
                        @endphp

                        {{-- Filter: Tampilkan hanya donasi yang kadaluarsanya hari ini atau besok --}}
                        @if ($kadaluwarsa->toDateString() < $today->toDateString())
                            @continue {{-- Skip donasi yang sudah kadaluarsa (kemarin dan sebelumnya) --}}
                        @endif
                        
                        {{-- Opsional: Jika ingin batasi hanya hari ini saja, uncomment baris di bawah --}}
                        {{-- @if ($kadaluwarsa->toDateString() > $today->toDateString())
                            @continue
                        @endif --}}

                        <div class="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition-shadow duration-300"
                            @click="open = true; selectedDonasi = {{ $donasi->toJson() }}">
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
                                    <span class="{{ $donasi->halal ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $donasi->halal ? 'Halal' : 'Tidak Halal' }}
                                    </span>
                                </p>
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
                        <p>Tidak ada donasi makanan tersedia.</p>
                    @endforelse
                </div>
            </section>

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
                                                   :class="selectedDonasi.halal ? 'text-green-600' : 'text-red-600'"
                                                   x-text="selectedDonasi.halal ? 'Halal' : 'Tidak Halal'"></p>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Kadaluarsa</label>
                                            <p class="text-sm text-gray-900" x-text="selectedDonasi.kadaluwarsa"></p>
                                        </div>
                                        
                                        <div x-show="selectedDonasi.deskripsi">
                                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                            <p class="text-sm text-gray-900" x-text="selectedDonasi.deskripsi"></p>
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
                            <!-- Tombol Ambil Donasi - FIXED URL -->
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
                    btn.classList.toggle('bg-white', i === index);
                    btn.classList.toggle('bg-white/50', i !== index);
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