<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Slideshow -->
            <div class="relative overflow-hidden rounded-lg shadow-lg">
                <!-- Slides -->
                <div id="carousel" class="flex transition-transform duration-700 ease-in-out w-[400%]">
                    @foreach (range(1, 4) as $i)
                        <div class="w-full flex-shrink-0">
                            <div class="relative h-64 md:h-96">
                                <img src="{{ asset("images/slide$i.jpg") }}" class="w-full h-full object-cover" alt="Slide {{ $i }}">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-white text-center px-4">
                                    <h2 class="text-2xl md:text-3xl font-bold mb-2">Mengidap Autoimun</h2>
                                    <p class="text-lg md:text-xl">Yuk bantu Mozza berjuang untuk sembuh!</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Indicators -->
                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                    @foreach (range(0, 3) as $i)
                        <button class="w-3 h-3 rounded-full bg-white/70 hover:bg-white transition" data-slide="{{ $i }}"></button>
                    @endforeach
                </div>
            </div>

            <!-- Default Dashboard Message -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
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

            // Auto slide every 5s
            setInterval(() => {
                index = (index + 1) % 4;
                updateSlide();
            }, 5000);

            // Manual slide
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
