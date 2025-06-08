<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Penerima Donasi
        </h2>
    </x-slot>

    <div class="py-10 max-w-5xl mx-auto px-4">
        <div class="bg-white p-8 rounded-xl shadow-md">
            <!-- Detail Donasi -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detail Donasi</h3>
                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="w-full md:w-1/3">
                        <img src="{{ asset('storage/' . $donasi->gambar) }}" class="rounded-xl w-full h-48 object-cover" alt="{{ $donasi->nama_makanan }}">
                    </div>
                    <div class="w-full md:w-2/3 space-y-2">
                        <div class="flex justify-between items-center">
                            <h4 class="text-xl font-bold text-gray-900">{{ $donasi->nama_makanan }}</h4>
                            <span class="text-base font-semibold text-green-600">{{ $donasi->halal }}</span>
                        </div>
                        <p class="text-gray-700">{{ $donasi->deskripsi_makanan }}</p>
                        <div class="text-sm text-gray-600">
                            <p><strong>🍲 Porsi:</strong> {{ $donasi->jumlah }}</p>
                            <p><strong>Kategori:</strong> {{ $donasi->kategori }}</p>
                            <p class="text-red-500 font-medium"><strong>Kedaluwarsa:</strong> {{ \Carbon\Carbon::parse($donasi->kadaluwarsa)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat Pengambilan -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Alamat Pengambilan</h3>
                <div class="p-4 border rounded-lg bg-gray-50 text-sm text-gray-700 space-y-1">
                    <p><strong>{{ $donasi->pengguna->name }}</strong> ({{ $donasi->pengguna->no_telepon }})</p>
                    <p>{{ $donasi->alamat }}</p>
                </div>
            </div>

            <!-- Form Penerima -->
            <form action="{{ route('form.penerima.store') }}" method="POST" class="space-y-6" x-data="{ checked1: false, checked2: false, checked3: false }">
                @csrf
                <input type="hidden" name="donasi_id" value="{{ $donasi->id }}">
                <input type="hidden" name="nama" value="{{ Auth::user()->name }}">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah Porsi yang dibutuhkan</label>
                    <input type="number" name="jumlah_diambil" min="1" max="{{ $donasi->jumlah }}" value="1" class="mt-1 w-28 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="space-y-2 text-sm text-gray-700">
                    <label class="flex items-start gap-2">
                        <input type="checkbox" x-model="checked1">
                        <span>Saya setuju bahwa makanan yang diterima merupakan donasi dan tidak dapat diperjualbelikan.</span>
                    </label>
                    <label class="flex items-start gap-2">
                        <input type="checkbox" x-model="checked2">
                        <span>Saya bertanggung jawab atas konsumsi makanan yang diterima.</span>
                    </label>
                    <label class="flex items-start gap-2">
                        <input type="checkbox" x-model="checked3">
                        <span>Saya menyetujui syarat dan ketentuan yang berlaku.</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            :disabled="!(checked1 && checked2 && checked3)"
                            class="w-full bg-blue-600 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-3 rounded-lg transition duration-200">
                        Ambil Donasi Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
