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
                            class="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer"
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
                                        Hari ini
                                    @elseif ($kadaluwarsa->isTomorrow())
                                        Besok
                                    @elseif ($diffInDays > 1)
                                        {{ $diffInDays }} hari lagi
                                    @elseif ($diffInDays === 1)
                                        Besok
                                    @elseif ($diffInDays === -1)
                                        Kemarin
                                    @elseif ($diffInDays < -1)
                                        Sudah lewat {{ abs($diffInDays) }} hari
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

        <!-- Pop-up Modal -->
        <div
            x-show="open"
            class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 flex items-center justify-center"
            x-cloak>
            <div class="bg-white p-6 rounded-lg max-w-md w-full relative">
                <button @click="open = false" class="absolute top-2 right-3 text-gray-600 hover:text-gray-800">&times;</button>
                <h2 class="text-xl font-bold mb-2" x-text="selectedDonasi.nama_makanan"></h2>
                <img :src="'/storage/' + selectedDonasi.gambar" class="w-full h-40 object-cover rounded mb-2" alt="">
                <p class="text-sm text-gray-600" x-text="selectedDonasi.alamat"></p>
                <p class="text-sm">Jumlah: <span x-text="selectedDonasi.jumlah"></span></p>
                <p class="text-sm">Status Halal: <span x-text="selectedDonasi.halal"></span></p>
                <p class="text-sm">Deskripsi: <span x-text="selectedDonasi.deskripsi_makanan"></span></p>
                <p class="text-sm">Kadaluarsa: <span x-text="selectedDonasi.kadaluwarsa"></span></p>
                <div class="mt-4">
                    <a :href="'/form-penerima/' + selectedDonasi.id" class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                        Ambil Donasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
