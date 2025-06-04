<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MakanYuk!</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('src/output.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <style>
    html, body { overflow-x: hidden; }
    main { margin-top: 4rem; }
  </style>
</head>

<body>
<header class="bg-white fixed w-full top-0 left-0 z-50 shadow-md">
  <nav class="container mx-auto flex items-center justify-between h-16 px-4">
    <div class="flex items-center gap-2">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
      <span class="font-Poppins text-xl sm:text-2xl font-semibold">MakanYuk!</span>
    </div>

    <div class="hidden lg:flex items-center gap-6 text-sm sm:text-base font-medium text-gray-700">
      <a href="#beranda" class="nav-link">Beranda</a>
      <a href="#cara_donasi" class="nav-link">Cara Donasi</a>
      <a href="#tentang_kami" class="nav-link">Tentang Kami</a>
      <a href="#review" class="nav-link">Review</a>
      <a href="#kontak" class="nav-link">Kontak</a>
      <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full shadow-md">Masuk</a>
    </div>

    <div class="lg:hidden text-xl sm:text-3xl cursor-pointer z-50" id="hamburger">
      <i class="ri-menu-4-line"></i>
    </div>
  </nav>
</header>

<main>
  <!-- Semua section lain tetap, cukup ganti semua src="..." jadi {{ asset('...') }} -->
  <section id="beranda" class="relative w-full min-h-screen faded-hero">
    <img src="{{ asset('images/551berbagi-buka-360x200.jpg') }}" alt="Header" class="absolute top-0 left-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center">
      <div class="px-6 container mx-auto md:flex md:justify-between items-center text-white">
        <div class="md:w-3/6 text-center md:text-left md:pl-10">
          <h4 class="text-xl font-bold">MakanYuk</h4>
          <h3 class="text-5xl font-bold mb-5">Berbagi Makanan, Peduli Sesama</h3>
          <p class="text-gray-200 mb-5">
            Sekecil apa pun makananmu, bisa jadi berkah untuk yang lain. Lewat Makanyuk!, mari berbagi dengan cepat dan mudah.
            Bersama kita bisa lawan kelaparan dan kurangi pemborosan. Karena peduli itu sederhana, tapi dampaknya luar biasa.
          </p>
          <div class="flex gap-4 justify-center md:justify-start">
            <a href="{{ route('donasi.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full shadow-md">
              Donasi Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Cara Donasi -->
<section id="cara_donasi" class="text-center py-12 bg-yellow-100 px-6">
  <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-10">Donasikan makananmu hari ini juga!</h2>

  <div class="flex justify-center items-center flex-wrap px-4 relative">
    
    <!-- Step 1 -->
    <div class="relative z-10 flex flex-col items-center mx-3 md:mx-6">
      <div class="w-28 h-28 md:w-32 md:h-32 rounded-full bg-white flex items-center justify-center shadow-lg">
        <img src="{{ asset('images/bukaweb.png') }}" alt="Buka Website" class="w-16 h-16 md:w-20 md:h-20" />
      </div>
      <p class="font-bold mt-4">Buka Website</p>
    </div>

    <!-- Garis antara step 1 & 2 -->
    <div class="w-10 h-1 bg-orange-400 md:w-20 mt-[-30px]"></div>

    <!-- Step 2 -->
    <div class="relative z-10 flex flex-col items-center mx-3 md:mx-6">
      <div class="w-28 h-28 md:w-32 md:h-32 rounded-full bg-white flex items-center justify-center shadow-lg">
        <img src="{{ asset('images/daftarsekarang.png') }}" alt="Login" class="w-16 h-16 md:w-20 md:h-20" />
      </div>
      <p class="font-bold mt-4">Login</p>
    </div>

    <!-- Garis antara step 2 & 3 -->
    <div class="w-10 h-1 bg-orange-400 md:w-20 mt-[-30px]"></div>

    <!-- Step 3 -->
    <div class="relative z-10 flex flex-col items-center mx-3 md:mx-6">
      <div class="w-28 h-28 md:w-32 md:h-32 rounded-full bg-white flex items-center justify-center shadow-lg">
        <img src="{{ asset('images/form.png') }}" alt="Isi Form" class="w-16 h-16 md:w-20 md:h-20" />
      </div>
      <p class="font-bold mt-4">Isi Form</p>
    </div>

    <!-- Garis antara step 3 & 4 -->
    <div class="w-10 h-1 bg-orange-400 md:w-20 mt-[-30px]"></div>

    <!-- Step 4 -->
    <div class="relative z-10 flex flex-col items-center mx-3 md:mx-6">
      <div class="w-28 h-28 md:w-32 md:h-32 rounded-full bg-white flex items-center justify-center shadow-lg">
        <img src="{{ asset('images/selesai.png') }}" alt="Selesai" class="w-16 h-16 md:w-20 md:h-20" />
      </div>
      <p class="font-bold mt-4">Selesai</p>
    </div>
  </div>
</section>


<!-- Tentang Kami -->
<section id="tentang_kami" class="bg-orange-500 text-white py-16 px-4 md:px-20">
  <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto">
    <!-- Teks -->
    <div class="md:w-2/3 mb-8 md:mb-0">
      <h2 class="text-4xl font-bold mb-6">Tentang MakanYuk!</h2>
      <p class="text-white text-lg leading-relaxed mb-4">
        MakanYuk! merupakan platform berbagi makanan dengan tujuan untuk mengurangi pemborosan pangan dan membantu mereka yang membutuhkan. 
        Melalui website ini, anda dapat dengan mudah membagikan makanan berlebih kepada penerima terdekat secara gratis.
      </p>
      <p class="text-white text-lg leading-relaxed">
        Dengan menghubungkan pemberi dan penerima dalam satu ekosistem digital, MakanYuk! tidak hanya mengurangi limbah makanan, 
        tetapi juga membangun solidaritas sosial dan kepedulian terhadap sesama. Kami percaya bahwa setiap makanan berharga, dan dengan berbagi, 
        kita dapat menciptakan perubahan positif di masyarakat.
      </p>
    </div>

    <!-- Gambar/logo -->
    <div class="md:w-1/3 flex justify-center">
      <img src="{{ asset('images/logobiru.png') }}" alt="Tentang MakanYuk!" class="w-48 md:w-60" />
    </div>
  </div>
</section>

<!-- Review -->
<section id="review" class="py-12 bg-yellow-100 text-center px-6">
  <div class="flex flex-col items-center gap-3 text-center mb-10 md:mb-20">
    <h2 class="text-3xl font-bold text-blue-900">Ulasan</h2>
    <p class="max-w-2xl text-gray-700">Apa kata mereka tentang MakanYuk?</p>
  </div>

  <div class="relative w-full max-w-6xl mx-auto">
    <div class="swiper reviewSwiper">
      <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide bg-white p-6 rounded-xl shadow-md">
          <img src="{{ asset('images/rev1.jpg') }}" alt="review_1"
               class="w-24 h-36 object-cover mx-auto rounded-lg" />
          <p class="font-medium mt-4">Bermanfaat, cepat, dan niat baiknya kerasa banget.</p>
        </div>

        <!-- Slide 2 -->
        <div class="swiper-slide bg-white p-6 rounded-xl shadow-md">
          <img src="{{ asset('images/rev2.jpg') }}" alt="review_2"
               class="w-24 h-36 object-cover mx-auto rounded-lg" />
          <p class="font-medium mt-4">Saya ikut bantu distribusi makanan dari Makanyuk! dan saya lihat sendiri wajah bahagia orang-orang yang menerima.</p>
        </div>

        <!-- Slide 3 -->
        <div class="swiper-slide bg-white p-6 rounded-xl shadow-md">
          <img src="{{ asset('images/rev3.jpg') }}" alt="review_3"
               class="w-24 h-36 object-cover mx-auto rounded-lg" />
          <p class="font-medium mt-4">Platform seperti ini seharusnya jadi standar di setiap kota besar. Good job, Makanyuk!</p>
        </div>

        <!-- Slide 4 -->
        <div class="swiper-slide bg-white p-6 rounded-xl shadow-md">
          <img src="{{ asset('images/rev4.jpg') }}" alt="review_4"
               class="w-24 h-36 object-cover mx-auto rounded-lg" />
          <p class="font-medium mt-4">Jadi superhero makanan tanpa pakai jubah. Cukup klik-klik di Makanyuk!</p>
        </div>
      </div>

      <!-- Bundaran & Panah -->
      <div class="swiper-pagination mt-6"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
</section>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Swiper Init -->
<script>
  const swiper = new Swiper('.reviewSwiper', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    breakpoints: {
      768: {
        slidesPerView: 2
      },
      1024: {
        slidesPerView: 3
      }
    }
  });
</script>



  <!-- Ulangi untuk section lain: gunakan asset() & route() sesuai kebutuhan -->
</main>

<footer id="kontak" class="bg-orange-400 text-white py-12 px-6">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center md:items-start gap-10">
    
    <!-- Kiri: Logo & Info Kontak -->
    <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
      <!-- Logo -->
      <div>
        <img src="{{ asset('images/logobiru.png') }}" alt="Logo MakanYuk!" class="w-28 md:w-32">
      </div>

      <!-- Info Kontak -->
      <div>
        <h2 class="text-xl font-bold mb-3">Hubungi Kami</h2>
        <div class="flex items-center gap-2 mb-2">
          <span class="text-2xl">📞</span>
          <span>+62 812-xxxx-xxxx</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="text-2xl">📧</span>
          <span>makanyuk!@gmail.com</span>
        </div>
      </div>
    </div>

    <!-- Kanan: Sosial Media -->
    <div class="flex flex-col items-center md:items-end">
      <h2 class="text-xl font-bold mb-3">Social Media</h2>
      <div class="flex gap-4 text-2xl">
        <a href="#" aria-label="Instagram" class="hover:text-gray-200">📸</a>
        <a href="#" aria-label="X (Twitter)" class="hover:text-gray-200">𝕏</a>
        <a href="#" aria-label="Facebook" class="hover:text-gray-200">📘</a>
      </div>
    </div>
  </div>

  <!-- Bawah: Legal -->
  <div class="border-t border-white mt-10 pt-4 flex flex-col md:flex-row justify-between items-center text-sm text-white">
    <div class="flex gap-6 mb-2 md:mb-0">
      <a href="#" class="hover:underline">Kebijakan Privasi</a>
      <a href="#" class="hover:underline">Syarat Ketentuan</a>
    </div>
    <p>&copy; {{ now()->year }} MakanYuk! - Semua Hak Dilindungi.</p>
  </div>
</footer>



</body>
</html>
