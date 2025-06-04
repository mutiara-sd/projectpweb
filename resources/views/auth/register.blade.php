<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
            
            <!-- KIRI - FORM REGISTER -->
            <div class="flex items-center justify-center p-10 bg-white">
                <div class="w-full max-w-md mx-auto">
                    <h2 class="text-3xl font-extrabold text-center mb-8">REGISTER</h2>

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <x-text-input id="email" name="email" type="email" :value="old('email')" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <x-text-input id="password" name="password" type="password" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex justify-center">
                            <x-primary-button
                                class="w-full bg-[#001f3f] hover:bg-[#001737] text-white py-2 px-4 rounded-md text-lg font-semibold text-center justify-center flex items-center">
                                {{ __('REGISTER') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <p class="mt-6 text-sm text-center text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-bold">Login</a>
                    </p>
                </div>
            </div>

            <!-- KANAN - LOGO & SLOGAN -->
            <div class="bg-yellow-100 flex flex-col items-center justify-center p-12">
                <img src="{{ asset('Images/LogoBiru.png') }}" alt="Logo MakanYuk" class="w-52 mb-6">
                <h1 class="text-5xl font-extrabold text-black mb-4">MakanYuk!</h1>
                <p class="text-xl text-center text-black leading-relaxed font-medium">
                    Mari berbagi makanan untuk yang membutuhkan 🍽️
                </p>
            </div>

        </div>
    </div>
</x-guest-layout>
