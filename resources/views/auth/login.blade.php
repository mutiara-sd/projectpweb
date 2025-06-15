<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-200 px-4">
        <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-gray-100">
            
            <!-- KIRI -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 flex flex-col items-center justify-center p-12 relative">
                <!-- Decorative elements -->
                <div class="absolute top-0 left-0 w-32 h-32 bg-yellow-200 rounded-full opacity-20 -translate-x-16 -translate-y-16"></div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-yellow-300 rounded-full opacity-20 translate-x-12 translate-y-12"></div>
                
                <div class="relative z-10 text-center">
                    <div class="bg-white rounded-2xl p-4 shadow-lg mb-8 inline-block">
                        <img src="{{ asset('Images/LogoBiru.png') }}" alt="Logo MakanYuk" class="w-52">
                    </div>
                    <h1 class="text-5xl font-extrabold text-gray-800 mb-4 tracking-tight">MakanYuk!</h1>
                    <div class="w-16 h-1 bg-yellow-500 mx-auto mb-4 rounded-full"></div>
                    <p class="text-xl text-center text-gray-700 leading-relaxed font-medium max-w-sm">
                        Berbagi Makanan, Peduli Sesama
                    </p>
                </div>
            </div>

            <!-- KANAN -->
            <div class="flex items-center justify-center p-10 bg-white relative">
                <!-- Subtle background pattern -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-blue-600 rounded-full -translate-y-20 translate-x-20"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-400 rounded-full translate-y-16 -translate-x-16"></div>
                </div>
                
                <div class="w-full max-w-md mx-auto relative z-10">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-extrabold text-gray-800 mb-2">LOGIN</h2>
                        <div class="w-12 h-1 bg-blue-600 mx-auto rounded-full"></div>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 hover:bg-white hover:border-gray-300 transition-all duration-200" 
                                    placeholder="Enter your email" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <x-text-input id="password" name="password" type="password" required
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 hover:bg-white hover:border-gray-300 transition-all duration-200" 
                                    placeholder="Enter your password" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="remember" class="mr-3 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"> 
                                <span class="text-gray-600 group-hover:text-gray-800 font-medium">Remember Me?</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition-colors duration-200">Forget Password?</a>
                            @endif
                        </div>

                        <div class="pt-2">
                            <x-primary-button
                                class="w-full bg-gradient-to-r from-[#001f3f] to-[#002a5c] hover:from-[#001737] hover:to-[#001f3f] text-white py-3 px-6 rounded-xl text-lg font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                {{ __('LOGIN') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-sm text-center text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-bold hover:underline ml-1 transition-colors duration-200">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>