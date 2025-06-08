<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Donasi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Donasi</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse ($donasis as $donasi)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
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
                                {{-- Tanggal Kadaluarsa Natural --}}
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
    </div>
</x-app-layout>
