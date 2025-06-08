<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Info Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- No Telepon -->
        <div>
            <x-input-label for="no_telepon" value="Nomor Telepon" />
            <x-text-input id="no_telepon" name="no_telepon" type="text" class="mt-1 block w-full" :value="old('no_telepon', $user->no_telepon)" autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('no_telepon')" />
        </div>

        <!-- Alamat Lengkap -->
        <div>
            <x-input-label for="lokasi_detail" value="Alamat Lengkap" />
            <x-text-input id="lokasi_detail" name="lokasi_detail" type="text" class="mt-1 block w-full" :value="old('lokasi_detail', $user->lokasi_detail)" autocomplete="street-address" />
            <x-input-error class="mt-2" :messages="$errors->get('lokasi_detail')" />
        </div>

        <!-- Lokasi (Dropdown) -->
        <div>
            <x-input-label for="lokasi_id" value="Lokasi" />
            <select id="lokasi_id" name="lokasi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Pilih Lokasi --</option>
                @foreach ($lokasis as $lokasi)
                    <option value="{{ $lokasi->lokasi_id }}" {{ $user->lokasi_id == $lokasi->lokasi_id ? 'selected' : '' }}>
                        {{ $lokasi->nama_lokasi }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('lokasi_id')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
