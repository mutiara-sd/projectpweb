<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Form Donasi') }}
            </h2>
        </div>
    </x-slot>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="max-w-4xl mx-auto px-8 py-10 bg-white rounded-xl shadow-2xl">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Mari Berbagi, Satu Porsi untuk Kebahagiaan</h1>
            <p class="text-gray-700 mb-10 text-lg leading-relaxed">
                Hai, terima kasih sudah mau berbagi! Dengan sedikit bantuan dari Anda, kita bisa membuat perbedaan besar bagi mereka yang membutuhkan.
                Yuk, isi informasi dengan lengkap supaya donasi ini bisa sampai ke tangan yang tepat!
            </p>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block font-semibold mb-2 text-gray-800">Nama Makanan</label>
                    <input type="text" name="nama_makanan" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-800">Kategori</label>
                    <select name="kategori" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option disabled selected>Pilih Kategori</option>
                        <option value="Makanan Kering">Makanan Kering</option>
                        <option value="Makanan Basah">Makanan Basah</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-800">Deskripsi Makanan</label>
                    <textarea name="deskripsi_makanan" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" required></textarea>
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-800">Lokasi</label>
                    <input type="text" name="alamat" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold mb-2 text-gray-800">Jumlah</label>
                        <input type="number" name="jumlah" min="1" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-2 text-gray-800">Tanggal Kadaluarsa</label>
                        <input type="date" name="kadaluwarsa" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-800">Status:</label>
                    <div class="flex items-center space-x-6 mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="halal" value="Halal" class="mr-2" required> Halal
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="halal" value="Non Halal" class="mr-2"> Non Halal
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-800">Masukkan Foto</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <button type="submit" class="w-full bg-blue-800 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Tambah Donasi
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
